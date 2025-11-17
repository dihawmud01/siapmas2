<?php

namespace App\Http\Controllers\Admin\Letter;

use App\Enums\LetterType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThumbnailController;
use App\Models\LetterAttachment;
use App\Models\Classification;
use App\Models\Letter;
use App\Models\PAC;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class OutgoingLetterController extends Controller
{
    public function index(Request $request): View
    {
        $since = $request->since;
        $until = $request->until;
        $filter = $request->filter;

        $user = Auth::user();

        $outgoingQuery = Letter::outgoing()->agenda($since, $until, $filter);

        if (in_array($user->role_id, [2, 3])) {

            $outgoingQuery = $outgoingQuery->where('user_id', $user->id);
        }


        $totalOutgoing = (clone $outgoingQuery)->count();

        $outgoing = $outgoingQuery->render($since, $until, $filter);
        $query = $request->getQueryString();

        return view(
            'admins.letters.outgoing.index',
            compact('outgoing', 'totalOutgoing', 'since', 'until', 'filter', 'query'),
        );
    }

    public function show(Letter $outgoing): View
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        return view('admins.letters.outgoing.show', compact('outgoing', 'pacSlug'));
    }

    public function print(Request $request): View
    {
        $user = Auth::user();

        $outgoingQuery = Letter::outgoing()
            ->agenda($request->since, $request->until, $request->filter);
        
         if (in_array($user->role_id, [2, 3])) {
         $outgoingQuery = $outgoingQuery->where('user_id', $user->id);
        }
        
        $outgoing = $outgoingQuery->get();

        $since = Carbon::parse($request->since)->isoFormat('DD-MM-YYYY');
        $until = Carbon::parse($request->until)->isoFormat('DD-MM-YYYY');
        $filter = $request->filter;

        return view('admins.letters.outgoing.print', compact('outgoing', 'since', 'until', 'filter'));
    }

    public function create(): View
    {
        $classifications = Classification::pluck('type', 'code')->toArray();

        return view('admins.letters.outgoing.create', compact('classifications'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'reference_number' => 'required|string|unique:letters,reference_number',
            'from' => 'nullable|string',
            'to' => 'nullable|string',
            'letter_date' => 'nullable|date',
            'received_date' => 'nullable|date|after_or_equal:letter_date',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'classification_code' => 'required|exists:classifications,code',
            'file' => 'nullable|file|mimes:pdf|max:2048',
            'attachments' => 'nullable|array',
            'attachments.*' => 'bail|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();
        $validatedData['user_id'] = $user->id;
        $validatedData['type'] = LetterType::OUTGOING->type();

        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';
        $outgoingNameSlug = Str::slug($validatedData['name']);

        $outgoing = Letter::create($validatedData);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $outgoingNameSlug . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = "documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}";
            $file->storeAs($path, $filename, 'public');

            $outgoing->file = $filename;
            $outgoing->save();

            app(ThumbnailController::class)->generateThumbnail(
                storage_path(
                    "app/public/documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/{$filename}",
                ),
                $filename,
                "letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}",
            );
        }

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $path = "documents/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}";

            foreach ($files as $idx => $file) {
                $filename = $idx + 1 . '-attachment-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $filename, 'public');

                LetterAttachment::create([
                    'letter_id' => $outgoing->id,
                    'file' => $filename,
                    'user_id' => $user->id,
                ]);

                app(ThumbnailController::class)->generateThumbnail(
                    storage_path(
                        "app/public/documents/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}/{$filename}",
                    ),
                    $filename,
                    "letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}",
                );
            }
        }

        Alert::success('Surat keluar berhasil ditambahkan');
        return redirect()->route('dashboard.letters.outgoing.index');
    }

    public function edit(Letter $outgoing): View
    {
        $classifications = Classification::pluck('type', 'code')->toArray();

        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        return view('admins.letters.outgoing.edit', compact('classifications', 'outgoing', 'pacSlug'));
    }

    public function update(Request $request, Letter $outgoing)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'reference_number' => [
                'required',
                'string',
                Rule::unique('letters', 'reference_number')->ignore($outgoing->id),
            ],
            'from' => 'nullable|string',
            'to' => 'nullable|string',
            'letter_date' => 'nullable|date',
            'received_date' => 'nullable|date|after_or_equal:letter_date',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'classification_code' => 'required|exists:classifications,code',
            'file' => 'nullable|file|mimes:pdf|max:2048',
            'attachments' => 'nullable|array',
            'attachments.*' => 'bail|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();
        $validatedData['user_id'] = $user->id;
        $validatedData['type'] = LetterType::OUTGOING->type();

        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';
        $outgoing = Str::slug($validatedData['name']);

        if ($request->delete_file == '1' && $outgoing->file) {
            $this->deleteFileAndThumbnail($outgoing, $pacSlug);

            $outgoing->file = null;
            $outgoing->save();
        }

        if ($request->hasFile('file')) {
            if ($outgoing->file) {
                $this->deleteFileAndThumbnail($outgoing, $pacSlug);
            }

            $file = $request->file('file');
            $filename = $outgoing . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = "documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}";
            $file->storeAs($path, $filename, 'public');

            $validatedData['file'] = $filename;
            $outgoing->save();

            app(ThumbnailController::class)->generateThumbnail(
                storage_path(
                    "app/public/documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/{$filename}",
                ),
                $filename,
                "letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}",
            );
        }

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $path = "documents/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}";

            foreach ($files as $idx => $file) {
                $filename = $idx + 1 . '-attachment-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $filename, 'public');

                LetterAttachment::create([
                    'letter_id' => $outgoing->id,
                    'file' => $filename,
                    'user_id' => $user->id,
                ]);

                app(ThumbnailController::class)->generateThumbnail(
                    storage_path(
                        "app/public/documents/letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}/{$filename}",
                    ),
                    $filename,
                    "letters/outgoing/{$pacSlug}/attachments/{$outgoing->id}",
                );
            }
        }

        $outgoing->update($validatedData);

        Alert::success('Surat keluar berhasil diperbarui');
        return redirect()->route('dashboard.letters.outgoing.show', $outgoing);
    }

    public function destroyAttachment(LetterAttachment $attachment)
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        $oldPath = "documents/letters/outgoing/{$pacSlug}/attachments/{$attachment->letter->id}/{$attachment->file}";
        Storage::disk('public')->delete($oldPath);

        $oldThumbnailPath =
            "images/thumbnails/letters/outgoing/{$pacSlug}/attachments/{$attachment->letter->id}/" .
            pathinfo($attachment->file, PATHINFO_FILENAME) .
            '.jpg';
        Storage::disk('public')->delete($oldThumbnailPath);

        $attachment->delete();

        Alert::success('Lampiran berhasil dihapus');

        return redirect()->route('dashboard.letters.outgoing.show', $attachment->letter->id);
    }

    function deleteFileAndThumbnail($outgoing, $pacSlug)
    {
        $oldPath = "documents/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/{$outgoing->file}";
        $oldThumbnailPath =
            "images/thumbnails/letters/outgoing/{$pacSlug}/soft-copies/{$outgoing->id}/" .
            pathinfo($outgoing->file, PATHINFO_FILENAME) .
            '.jpg';

        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        if (Storage::disk('public')->exists($oldThumbnailPath)) {
            Storage::disk('public')->delete($oldThumbnailPath);
        }
    }

    public function destroy(Letter $outgoing)
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        if ($outgoing->file) {
            $this->deleteFileAndThumbnail($outgoing, $pacSlug);
        }

        $attachments = LetterAttachment::where('letter_id', $outgoing->id)->get();

        foreach ($attachments as $attachment) {
            $oldPath = "documents/letters/outgoing/{$pacSlug}/attachments/{$attachment->letter->id}/{$attachment->file}";
            Storage::disk('public')->delete($oldPath);

            $oldThumbnailPath =
                "images/thumbnails/letters/outgoing/{$pacSlug}/attachments/{$attachment->letter->id}/" .
                pathinfo($attachment->file, PATHINFO_FILENAME) .
                '.jpg';
            Storage::disk('public')->delete($oldThumbnailPath);

            $attachment->delete();
        }

        $outgoing->delete();

        Alert::success('Surat keluar berhasil dihapus');

        return redirect()->route('dashboard.letters.outgoing.index');
    }
}