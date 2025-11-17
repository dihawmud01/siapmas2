<?php

namespace App\Http\Controllers\Admin\Letter;

use App\Enums\FileCategory;
use App\Enums\SubmissionStatus;
use App\Http\Controllers\Controller;
use App\Models\SP;
use App\Models\SPSubmissionFile;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada di atas

class SPController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $type = $request->query('type'); // Ambil parameter 'type' dari URL

        // Filter berdasarkan user_id dan type
        $query = SP::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc');

        if ($user->id == 2) {
            $query = SP::orderBy('updated_at', 'desc');
        }

        // Tambahkan filter berdasarkan 'type' jika ada
        if ($type) {
            $query->where('type', strtoupper($type)); // Pastikan type sesuai format penyimpanan
        }

        $letters = $query->get();

        // Kirim data 'type' ke view
        return view('admins.letters.sp.index', compact('letters', 'user', 'type'));
    }



    public function create()
    {
        $user = Auth::user();

        return view('admins.letters.sp.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            array_merge(
                [
                    'type' => 'required|string',
                    'start_period' => 'required|integer',
                    'end_period' => 'required|integer',
                    'event_date' => 'required|date',
                    'event_location' => 'required|string|max:255',
                    'mwc_letter_number' => 'required|string|max:255',

                    'protectors' => 'nullable|array',
                    'advisors' => 'nullable|array',
                    'chairman' => 'required|string|max:255',
                    'vice_chairmen' => 'nullable|array',
                    'secretary' => 'required|string|max:255',
                    'vice_secretaries' => 'nullable|array',
                    'treasurer' => 'required|string|max:255',
                    'vice_treasurers' => 'nullable|array',
                    'organization_department_coordinator' => 'required|string|max:255',
                    'organization_department_members' => 'nullable|array',
                    'cadre_department_coordinator' => 'required|string|max:255',
                    'cadre_department_members' => 'nullable|array',
                    'dakwah_department_coordinator' => 'required|string|max:255',
                    'dakwah_department_members' => 'nullable|array',
                    'culture_department_coordinator' => 'required|string|max:255',
                    'culture_department_members' => 'nullable|array',
                    'economy_institution_director' => 'required|string|max:255',
                    'economy_institution_members' => 'nullable|array',
                    'press_institution_director' => 'required|string|max:255',
                    'press_institution_members' => 'nullable|array',
                    'brigade_institution_director' => 'required|string|max:255',
                    'brigade_institution_members' => 'nullable|array',
                ],
                [
                    'documentations' => 'required|array|min:1',
                    'documentations.*' => 'file|mimes:docx,jpeg,png|max:2048',
                    'request_letter' => 'required|file|mimes:pdf|max:2048',
                    'mwc_recommendation' => 'required|file|mimes:pdf|max:2048',
                    'pac_recommendation' => 'required|file|mimes:pdf|max:2048',
                    'election_report' => 'required|file|mimes:pdf|max:2048',
                    'formation_report' => 'required|file|mimes:pdf|max:2048',
                    'id_cv_photo_certificate' => 'required|file|mimes:pdf|max:2048',
                    'management_structure' => 'required|file|mimes:docx|max:2048',
                ],
            ),
        );

        $user = Auth::user();
        $validatedData['user_id'] = $user->id;

        $letter = SP::create($validatedData);

        $pacSlug = Str::slug($user->pac->pac);

        $fileCategories = [
            'documentations' => 'documentation',
            'request_letter' => 'request_letter',
            'mwc_recommendation' => 'mwc_recommendation',
            'pac_recommendation' => 'pac_recommendation',
            'election_report' => 'election_report',
            'formation_report' => 'formation_report',
            'id_cv_photo_certificate' => 'id_cv_photo_certificate',
            'management_structure' => 'management_structure',
        ];

        foreach ($fileCategories as $field => $category) {
            if ($request->hasFile($field)) {
                $files = is_array($request->file($field)) ? $request->file($field) : [$request->file($field)];

                $folder = Str::plural($category);

                $path = "documents/letters/sp/{$pacSlug}/{$folder}/{$letter->id}/";

                foreach ($files as $file) {
                    $filename = $category . '-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs($path, $filename, 'public');

                    SPSubmissionFile::create([
                        'sp_id' => $letter->id,
                        'attachment' => $filename,
                        'category' => FileCategory::tryFrom($category),
                    ]);
                }
            }
        }

        Alert::success('Pengajuan berhasil dikirim', 'Data-data akan ditinjau terlebih dahulu oleh PC');

        return redirect()->route('dashboard.letters.validation-submission.index', ['type' => $validatedData['type']]);
    }

    public function show($id): View
    {
        $letter = SP::findOrFail($id);

        $attachments = (object) SPSubmissionFile::where('sp_id', $letter->id)
            ->whereIn('category', [
                'request_letter',
                'documentation',
                'mwc_recommendation',
                'pac_recommendation',
                'election_report',
                'formation_report',
                'management_structure',
                'id_cv_photo_certificate',
            ])
            ->get()
            ->groupBy('category')
            ->map(function ($group, $key) {
                if ($key === 'documentation') {
                    return $group->pluck('attachment');
                }
                return $group->pluck('attachment')->first();
            })
            ->toArray();

        return view('admins.letters.sp.show', compact('letter', 'attachments'));
    }

    public function approve(Request $request, SP $letter): RedirectResponse
    {
        $validatedLetterNum = $request->validate(['letter_number' => 'required|string|max:255']);

        $letter->update([
            'letter_number' => $validatedLetterNum['letter_number'],
            'status' => SubmissionStatus::APPROVED,
        ]);

        Alert::success('Pengajuan SP berhasil disetujui');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }
    
    
public function downloadStructureFile($pac, $id, $filename)
{
    $filePath = "documents/letters/sp/{$pac}/management_structures/{$id}/{$filename}";

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    return Storage::disk('public')->download($filePath);
}

    public function reject(SP $letter): RedirectResponse
    {
        $letter->update([
            'status' => SubmissionStatus::REJECTED,
        ]);

        Alert::success('Pengajuan SP berhasil ditolak');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }
    public function generateIPNUSP(SP $letter)
    {
        $user = Auth::user();
        $pacSlug = Str::slug($user->pac->pac);
        $pac = in_array($user->pac_id, [28, 29]) ? $user->pac->pac : 'KECAMATAN ' . $user->pac->pac;

        $letter->update(['generated_at' => now()]);

        $dynamicCoverPath = public_path("storage/documents/letters/sp/{$pacSlug}/ipnu/");
        $dynamicCover = "{$dynamicCoverPath}/ipnu-sp-cover.pdf";

        if (! is_dir($dynamicCoverPath)) {
            mkdir($dynamicCoverPath, 0755, true);
        }

        if (! file_exists($dynamicCover)) {
            $coverPath = '../public_html/assets/documents/ipnu-sp-cover.pdf';
            $cover = new Fpdi();
            $cover->setSourceFile($coverPath);
            $tplIdx = $cover->importPage(1);
            $size = $cover->getTemplateSize($tplIdx);
            $cover->AddPage('P', [$size['width'], $size['height']]);
            $cover->useTemplate($tplIdx, 0, 0, $size['width'], $size['height']);
            $cover->setFont('Helvetica', 'B', 26);
            $cover->setTextColor(255, 255, 255);
            $cover->SetXY(59.5, 190);
            $cover->Cell(100, 10, $pac, 0, 0, 'C');
            $cover->Output($dynamicCover, 'F');
        }

        $contentPdf = Pdf::setPaper('A4', 'portrait')->loadView(
            'admins.letters.sp.pdf.ipnu.layout',
            compact('letter', 'pac'),
        );

        $contentPath = storage_path('app/public/documents/letters/sp/content.pdf');
        file_put_contents($contentPath, $contentPdf->output());

        $merger = new Merger();
        $merger->addFile($dynamicCover);
        $merger->addFile($contentPath);
        $mergedPdf = $merger->merge();

        $spDirectory = public_path("storage/documents/letters/sp/{$pacSlug}/ipnu/generated/{$letter->id}");
        if (! is_dir($spDirectory)) {
            mkdir($spDirectory, 0755, true);
        }

        $filename = 'surat-pengesahan-ipnu-' . now()->timestamp . '.pdf';
        $mergedPath = $spDirectory . '/' . $filename;

        file_put_contents($mergedPath, $mergedPdf);

        unlink($contentPath);

        return response()->file($mergedPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function generateIPPNUSP(SP $letter)
    {
        $user = Auth::user();
        $pacSlug = Str::slug($user->pac->pac);
        $pac = in_array($user->pac_id, [28, 29]) ? $user->pac->pac : 'KECAMATAN ' . $user->pac->pac;

        $letter->update(['generated_at' => now()]);

        $path = public_path("storage/documents/letters/sp/{$pacSlug}/ippnu/generated/{$letter->id}");

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $pdf = Pdf::setPaper('F4', 'portrait')->loadView(
            'admins.letters.sp.pdf.ippnu.layout',
            compact('letter', 'pac'),
        );

        $filename = 'surat-pengesahan-ippnu-' . now()->timestamp . '.pdf';
        $filePath = $path . '/' . $filename;

        file_put_contents($filePath, $pdf->output());

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}