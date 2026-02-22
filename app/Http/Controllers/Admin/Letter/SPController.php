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

        // Filter berdasarkan user_id dan type - with eager loading to prevent N+1
        $query = SP::with(['user.pac'])
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc');

        if ($user->id == 2) {
            $query = SP::with(['user.pac'])->orderBy('updated_at', 'desc');
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
                    'organization_level' => 'required|string|in:PAC,PR,PK',
                    'sub_organization_name' => 'required_if:organization_level,PR,PK|nullable|string|max:255',
                    'start_period' => 'required|integer',
                    'end_period' => 'required|integer',
                    'event_date' => 'required|date',
                    'event_location' => 'required|string|max:255',
                    'pelantikan_date' => 'required|date',
                    'mwc_letter_number' => 'required|string|max:255',
                    'mwc_letter_date' => 'required|date',
                    'pac_letter_number' => 'required_if:organization_level,PR,PK|nullable|string|max:255',
                    'pac_letter_date' => 'required_if:organization_level,PR,PK|nullable|date',

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

        // Hitung expired_at = pelantikan_date + 2 tahun
        if (! empty($validatedData['pelantikan_date'])) {
            $validatedData['expired_at'] = \Carbon\Carbon::parse($validatedData['pelantikan_date'])
                ->addYears(2)
                ->toDateTimeString();
        }

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

    public function edit($id): View
    {
        $user = Auth::user();
        $letter = SP::findOrFail($id);

        // Hanya pembuat surat yang bisa mengedit, dan hanya jika statusnya rejected
        if ($letter->user_id !== $user->id || $letter->status->value !== 'rejected') {
            abort(403, 'Unauthorized action.');
        }

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

        return view('admins.letters.sp.edit', compact('user', 'letter', 'attachments'));
    }

    public function update(Request $request, $id)
    {
        $letter = SP::findOrFail($id);
        $user = Auth::user();

        if ($letter->user_id !== $user->id || $letter->status->value !== 'rejected') {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate(
            array_merge(
                [
                    'type' => 'required|string',
                    'organization_level' => 'required|string|in:PAC,PR,PK',
                    'sub_organization_name' => 'required_if:organization_level,PR,PK|nullable|string|max:255',
                    'start_period' => 'required|integer',
                    'end_period' => 'required|integer',
                    'event_date' => 'required|date',
                    'event_location' => 'required|string|max:255',
                    'pelantikan_date' => 'required|date',
                    'mwc_letter_number' => 'required|string|max:255',
                    'mwc_letter_date' => 'required|date',
                    'pac_letter_number' => 'required_if:organization_level,PR,PK|nullable|string|max:255',
                    'pac_letter_date' => 'required_if:organization_level,PR,PK|nullable|date',

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
                    'documentations' => 'nullable|array|min:1',
                    'documentations.*' => 'file|mimes:docx,jpeg,png|max:2048',
                    'request_letter' => 'nullable|file|mimes:pdf|max:2048',
                    'mwc_recommendation' => 'nullable|file|mimes:pdf|max:2048',
                    'pac_recommendation' => 'nullable|file|mimes:pdf|max:2048',
                    'election_report' => 'nullable|file|mimes:pdf|max:2048',
                    'formation_report' => 'nullable|file|mimes:pdf|max:2048',
                    'id_cv_photo_certificate' => 'nullable|file|mimes:pdf|max:2048',
                    'management_structure' => 'nullable|file|mimes:docx|max:2048',
                ],
            ),
        );

        // Hitung ulang expired_at
        if (! empty($validatedData['pelantikan_date'])) {
            $validatedData['expired_at'] = \Carbon\Carbon::parse($validatedData['pelantikan_date'])
                ->addYears(2)
                ->toDateTimeString();
        }

        // Kembalikan statusnya ke pending
        $validatedData['status'] = SubmissionStatus::PENDING;
        // Optionally, nullify the rejection reason since it's being resubmitted
        $validatedData['rejection_reason'] = null;

        $letter->update($validatedData);

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

                // Hapus file lama untuk kategori ini.
                // Untuk documentations, hapus semua existing documentations
                $existingFilesData = SPSubmissionFile::where('sp_id', $letter->id)
                    ->where('category', FileCategory::tryFrom($category))
                    ->get();

                foreach ($existingFilesData as $existingFile) {
                    if (Storage::disk('public')->exists($path . $existingFile->attachment)) {
                        Storage::disk('public')->delete($path . $existingFile->attachment);
                    }
                    $existingFile->delete();
                }

                // Tambahkan file baru
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

        Alert::success('Pengajuan berhasil direvisi', 'Data-data akan ditinjau ulang oleh PC');

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
        $validated = $request->validate([
            'letter_number' => 'required|string|max:255',
        ]);

        $letter->update([
            'letter_number' => $validated['letter_number'],
            'status' => SubmissionStatus::APPROVED,
        ]);

        Alert::success('Pengajuan SP berhasil disetujui');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }

    public function downloadStructureFile($pac, $id, $filename)
    {
        $filePath = "documents/letters/sp/{$pac}/management_structures/{$id}/{$filename}";

        if (! Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function reject(Request $request, SP $letter): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $letter->update([
            'status' => SubmissionStatus::REJECTED,
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        Alert::success('Pengajuan SP berhasil ditolak');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }
    public function generateIPNUSP(SP $letter)
    {
        $user = $letter->user;
        $pacSlug = Str::slug($user->pac->pac);
        $pacNameRaw = $user->pac->pac;
        $pac = in_array($user->pac_id, [28, 29]) ? $pacNameRaw : 'KECAMATAN ' . $pacNameRaw;

        // Dynamic organizational labels based on organization_level
        $orgLevel = $letter->organization_level;
        $orgLabel = $orgLevel->label();
        $orgShort = $orgLevel->shortLabel();
        $subOrgName = $letter->sub_organization_name;
        $eventType = $orgLevel->eventTypeName();
        $brigadeLabel = $orgLevel->brigadeLabel();

        // For cover page: determine the organization name to display
        if ($orgLevel->value === 'PAC') {
            // For PAC cover: show only "KECAMATAN [PAC]" without the "PAC" prefix
            $coverOrgName = 'KECAMATAN ' . $pacNameRaw;
            $coverLine1 = strtoupper($coverOrgName);
            $coverLine2 = null;
        } else {
            // For PR/PK: Line 1 = "RANTING [name]", Line 2 = "KECAMATAN [PAC]"
            $coverOrgName = $subOrgName;
            $levelPrefix = $orgLevel->value === 'PR' ? 'RANTING ' : 'KOMISARIAT ';
            $coverLine1 = strtoupper($levelPrefix . $subOrgName);
            $coverLine2 = strtoupper('KECAMATAN ' . $pacNameRaw);
        }

        // Check if PDF already generated for this letter (reuse if exists)
        $spDirectory = public_path("storage/documents/letters/sp/{$pacSlug}/ipnu/generated/{$letter->id}");
        $existingFiles = is_dir($spDirectory) ? glob($spDirectory . '/surat-pengesahan-ipnu-*.pdf') : [];

        // if (! empty($existingFiles) && $letter->generated_at) {
        //     // Return existing PDF if already generated
        //     $existingFile = end($existingFiles);
        //     return response()->file($existingFile, [
        //         'Content-Type' => 'application/pdf',
        //         'Content-Disposition' => 'inline; filename="' . basename($existingFile) . '"',
        //     ]);
        // }

        $letter->update(['generated_at' => now()]);

        $dynamicCoverPath = public_path("storage/documents/letters/sp/{$pacSlug}/ipnu/");
        $coverFileName = 'ipnu-sp-cover-' . Str::slug($coverOrgName) . '.pdf';
        $dynamicCover = "{$dynamicCoverPath}/{$coverFileName}";

        if (! is_dir($dynamicCoverPath)) {
            mkdir($dynamicCoverPath, 0755, true);
        }

        // Only regenerate cover if it doesn't exist (caching)
        // Always regenerate cover to ensure latest changes are applied
        // if (! file_exists($dynamicCover)) {
        $coverPath = '../public/assets/documents/ipnu-sp-cover.pdf';
        $cover = new Fpdi();
        $cover->setSourceFile($coverPath);
        $tplIdx = $cover->importPage(1);
        $size = $cover->getTemplateSize($tplIdx);
        $cover->AddPage('P', [$size['width'], $size['height']]);
        $cover->useTemplate($tplIdx, 0, 0, $size['width'], $size['height']);

        if ($coverLine2) {
            // Hide existing "PIMPINAN ANAK CABANG" text on the template
            // Corrected IPNU Green from user image
            $cover->SetFillColor(143, 197, 47);
            $cover->Rect(0, 175, 216, 35, 'F');

            $cover->setFont('Helvetica', 'B', 24);
            $cover->setTextColor(255, 255, 255);

            // Two lines for PR/PK - positioned lower to not cover upper text
            $cover->SetXY(58, 190);
            $cover->Cell(100, 10, $coverLine1, 0, 0, 'C');
            $cover->SetXY(58, 200);
            $cover->Cell(100, 10, $coverLine2, 0, 0, 'C');
        } else {
            $cover->setFont('Helvetica', 'B', 26);
            $cover->setTextColor(255, 255, 255);
            // Single line for PAC
            $cover->SetXY(59.5, 190);
            $cover->Cell(100, 10, $coverLine1, 0, 0, 'C');
        }
        $cover->Output($dynamicCover, 'F');

        $imgDir = public_path('assets/images/sp');
        $headerImg = base64_encode(file_get_contents($imgDir . '/ipnu/header.png'));
        $footerImg = base64_encode(file_get_contents($imgDir . '/ipnu/footer.jpeg'));
        $chairSig = base64_encode(file_get_contents($imgDir . '/signatures/chairman-signature.png'));
        $secSig = base64_encode(file_get_contents($imgDir . '/signatures/secretary-signature.png'));

        $contentPdf = Pdf::setPaper('A4', 'portrait')->loadView(
            'admins.letters.sp.pdf.ipnu.layout',
            compact(
                'letter',
                'pac',
                'pacNameRaw',
                'orgLabel',
                'orgShort',
                'subOrgName',
                'eventType',
                'brigadeLabel',
                'coverOrgName',
                'coverLine2',
                'headerImg',
                'footerImg',
                'chairSig',
                'secSig',
            ),
        );

        $contentPath = storage_path('app/public/documents/letters/sp/content.pdf');
        file_put_contents($contentPath, $contentPdf->output());

        $merger = new Merger();
        $merger->addFile($dynamicCover);
        $merger->addFile($contentPath);
        $mergedPdf = $merger->merge();

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
        $user = $letter->user;
        $pacSlug = Str::slug($user->pac->pac);
        $pacNameRaw = $user->pac->pac;
        $pac = in_array($user->pac_id, [28, 29]) ? $pacNameRaw : 'KECAMATAN ' . $pacNameRaw;

        // Dynamic organizational labels based on organization_level
        $orgLevel = $letter->organization_level;
        $orgLabel = $orgLevel->label();
        $orgShort = $orgLevel->shortLabel();
        $subOrgName = $letter->sub_organization_name;
        $eventType = $orgLevel->eventTypeName();
        $brigadeLabel = $orgLevel->brigadeLabel();
        $coverOrgName = $orgLevel->value === 'PAC' ? $pac : $subOrgName;

        // Check if PDF already generated for this letter (reuse if exists)
        $spDirectory = public_path("storage/documents/letters/sp/{$pacSlug}/ippnu/generated/{$letter->id}");
        $existingFiles = is_dir($spDirectory) ? glob($spDirectory . '/surat-pengesahan-ippnu-*.pdf') : [];

        if (! empty($existingFiles) && $letter->generated_at) {
            // Return existing PDF if already generated
            $existingFile = end($existingFiles);
            return response()->file($existingFile, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($existingFile) . '"',
            ]);
        }

        $letter->update(['generated_at' => now()]);

        if (! is_dir($spDirectory)) {
            mkdir($spDirectory, 0755, true);
        }

        // Read and encode images to base64 for PDF
        $imgDir = public_path('assets/images/sp');
        $headerImg = base64_encode(file_get_contents($imgDir . '/ippnu/header.png'));
        $logoImg = base64_encode(file_get_contents($imgDir . '/ippnu/logo.png'));
        $chairSig = base64_encode(file_get_contents($imgDir . '/signatures/chairman-ipp-signature.png'));
        $secSig = base64_encode(file_get_contents($imgDir . '/signatures/secretary-ipp-signaturree.png'));

        $pdf = Pdf::setPaper('F4', 'portrait')->loadView(
            'admins.letters.sp.pdf.ippnu.layout',
            compact(
                'letter',
                'pac',
                'pacNameRaw',
                'orgLabel',
                'orgShort',
                'subOrgName',
                'eventType',
                'brigadeLabel',
                'coverOrgName',
                'headerImg',
                'logoImg',
                'chairSig',
                'secSig',
            ),
        );

        $filename = 'surat-pengesahan-ippnu-' . now()->timestamp . '.pdf';
        $filePath = $spDirectory . '/' . $filename;

        file_put_contents($filePath, $pdf->output());

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
