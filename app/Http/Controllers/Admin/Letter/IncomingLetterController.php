<?php

namespace App\Http\Controllers\Admin\Letter;

use App\Enums\LetterType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThumbnailController;
use App\Models\LetterAttachment;
use App\Models\Classification;
use App\Models\Letter;
use App\Models\Member;
use App\Models\PAC;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\PdfToImage\Pdf;

class IncomingLetterController extends Controller
{
    public function index(Request $request): View
    {
        $since = $request->since;
        $until = $request->until;
        $filter = $request->filter;

        $user = Auth::user();

        $incomingQuery = Letter::incoming()->agenda($since, $until, $filter);

        if (in_array($user->role_id, [2, 3])) {

            $incomingQuery = $incomingQuery->where('user_id', $user->id);
        }

        $totalIncoming = (clone $incomingQuery)->count();

        $incoming = $incomingQuery->render($since, $until, $filter);
        $query = $request->getQueryString();

        return view(
            'admins.letters.incoming.index',
            compact('incoming', 'totalIncoming', 'since', 'until', 'filter', 'query'),
        );
    }

    public function show(Letter $incoming): View
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        return view('admins.letters.incoming.show', compact('incoming', 'pacSlug'));
    }

    public function print(Request $request): View
    {
        $user = Auth::user();
    
        $incomingQuery = Letter::incoming()
            ->agenda($request->since, $request->until, $request->filter);
    
        if (in_array($user->role_id, [2, 3])) {
            $incomingQuery = $incomingQuery->where('user_id', $user->id);
        }
    
        $incoming = $incomingQuery->get();
    
        $since = Carbon::parse($request->since)->isoFormat('DD-MM-YYYY');
        $until = Carbon::parse($request->until)->isoFormat('DD-MM-YYYY');
        $filter = $request->filter;
    
        return view('admins.letters.incoming.print', compact('incoming', 'since', 'until', 'filter'));
    }


    public function create(): View
    {
        $classifications = Classification::pluck('type', 'code')->toArray();

        return view('admins.letters.incoming.create', compact('classifications'));
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
        $validatedData['type'] = LetterType::INCOMING->type();

        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';
        $incomingNameSlug = Str::slug($validatedData['name']);

        $incoming = Letter::create($validatedData);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $incomingNameSlug . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();

            ($filename);
            $path = "documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}";
            $file->storeAs($path, $filename, 'public');

            $incoming->file = $filename;
            $incoming->save();

            app(ThumbnailController::class)->generateThumbnail(
                storage_path(
                    "app/public/documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}/{$filename}",
                ),
                $filename,
                "letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}",
            );
        }

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $path = "documents/letters/incoming/{$pacSlug}/attachments/{$incoming->id}";

            foreach ($files as $idx => $file) {
                $filename = $idx + 1 . '-attachment-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $filename, 'public');

                LetterAttachment::create([
                    'letter_id' => $incoming->id,
                    'file' => $filename,
                    'user_id' => $user->id,
                ]);

                app(ThumbnailController::class)->generateThumbnail(
                    storage_path(
                        "app/public/documents/letters/incoming/{$pacSlug}/attachments/{$incoming->id}/{$filename}",
                    ),
                    $filename,
                    "letters/incoming/{$pacSlug}/attachments/{$incoming->id}",
                );
            }
        }

        Alert::success('Surat masuk berhasil ditambahkan');
        return redirect()->route('dashboard.letters.incoming.index');
    }

    public function edit(Letter $incoming): View
    {
        $classifications = Classification::pluck('type', 'code')->toArray();

        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        return view('admins.letters.incoming.edit', compact('classifications', 'incoming', 'pacSlug'));
    }

    public function update(Request $request, Letter $incoming)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'reference_number' => [
                'required',
                'string',
                Rule::unique('letters', 'reference_number')->ignore($incoming->id),
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
        $validatedData['type'] = LetterType::INCOMING->type();

        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';
        $incomingNameSlug = Str::slug($validatedData['name']);

        if ($request->delete_file == '1' && $incoming->file) {
            $this->deleteFileAndThumbnail($incoming, $pacSlug);

            $incoming->file = null;
            $incoming->save();
        }

        if ($request->hasFile('file')) {
            if ($incoming->file) {
                $this->deleteFileAndThumbnail($incoming, $pacSlug);
            }

            $file = $request->file('file');
            $filename = $incomingNameSlug . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = "documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}";
            $file->storeAs($path, $filename, 'public');

            $validatedData['file'] = $filename;
            $incoming->save();

            app(ThumbnailController::class)->generateThumbnail(
                storage_path(
                    "app/public/documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}/{$filename}",
                ),
                $filename,
                "letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}",
            );
        }

        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $path = "documents/letters/incoming/{$pacSlug}/attachments/{$incoming->id}";

            foreach ($files as $idx => $file) {
                $filename = $idx + 1 . '-attachment-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $filename, 'public');

                LetterAttachment::create([
                    'letter_id' => $incoming->id,
                    'file' => $filename,
                    'user_id' => $user->id,
                ]);

                app(ThumbnailController::class)->generateThumbnail(
                    storage_path(
                        "app/public/documents/letters/incoming/{$pacSlug}/attachments/{$incoming->id}/{$filename}",
                    ),
                    $filename,
                    "letters/incoming/{$pacSlug}/attachments/{$incoming->id}",
                );
            }
        }

        $incoming->update($validatedData);

        Alert::success('Surat masuk berhasil diperbarui');
        return redirect()->route('dashboard.letters.incoming.show', $incoming);
    }

    public function destroyAttachment(LetterAttachment $attachment)
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        $oldPath = "documents/letters/incoming/{$pacSlug}/attachments/{$attachment->letter->id}/{$attachment->file}";
        Storage::disk('public')->delete($oldPath);

        $oldThumbnailPath =
            "images/thumbnails/letters/incoming/{$pacSlug}/attachments/{$attachment->letter->id}/" .
            pathinfo($attachment->file, PATHINFO_FILENAME) .
            '.jpg';
        Storage::disk('public')->delete($oldThumbnailPath);

        $attachment->delete();

        Alert::success('Lampiran berhasil dihapus');

        return redirect()->route('dashboard.letters.incoming.show', $attachment->letter->id);
    }

    function deleteFileAndThumbnail($incoming, $pacSlug)
    {
        $oldPath = "documents/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}/{$incoming->file}";
        $oldThumbnailPath =
            "images/thumbnails/letters/incoming/{$pacSlug}/soft-copies/{$incoming->id}/" .
            pathinfo($incoming->file, PATHINFO_FILENAME) .
            '.jpg';

        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        if (Storage::disk('public')->exists($oldThumbnailPath)) {
            Storage::disk('public')->delete($oldThumbnailPath);
        }
    }

    public function destroy(Letter $incoming)
    {
        $user = Auth::user();
        $pacSlug = $user->role_id === 3 ? Str::slug(PAC::find($user->pac_id)?->pac ?? 'unknown') : 'pc';

        if ($incoming->file) {
            $this->deleteFileAndThumbnail($incoming, $pacSlug);
        }

        $attachments = LetterAttachment::where('letter_id', $incoming->id)->get();

        foreach ($attachments as $attachment) {
            $oldPath = "documents/letters/incoming/{$pacSlug}/attachments/{$attachment->letter->id}/{$attachment->file}";
            Storage::disk('public')->delete($oldPath);

            $oldThumbnailPath =
                "images/thumbnails/letters/incoming/{$pacSlug}/attachments/{$attachment->letter->id}/" .
                pathinfo($attachment->file, PATHINFO_FILENAME) .
                '.jpg';
            Storage::disk('public')->delete($oldThumbnailPath);

            $attachment->delete();
        }

        $incoming->delete();

        Alert::success('Surat masuk berhasil dihapus');

        return redirect()->route('dashboard.letters.incoming.index');
    }
}