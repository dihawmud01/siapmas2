<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;

class ThumbnailController extends Controller
{
    public function generateThumbnail($filePath, $filename, $directory)
    {
        $thumbnailDir = storage_path("app/public/images/thumbnails/{$directory}");

        if (! is_dir($thumbnailDir)) {
            mkdir($thumbnailDir, 0755, true);
        }

        $thumbnailFilename = pathinfo($filename, PATHINFO_FILENAME) . '.jpg';
        $thumbnailPath = "{$thumbnailDir}/{$thumbnailFilename}";

        if (file_exists($filePath) && ! file_exists($thumbnailPath)) {
            $pdf = new Pdf($filePath);

            $pdf->selectPage(1)
                ->thumbnailSize(400)
                ->save($thumbnailPath);
        }
    }
}