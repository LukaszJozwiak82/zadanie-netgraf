<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Barcode;
use Intervention\Image\ImageManagerStatic;
use Milon\Barcode\DNS1D;
use Str;

class BarcodeService
{
    private $filename;
    private $filepath;

    public function generateBarcode($request): void
    {
        $this->filename = Str::random(10).'.webp';
        $img = ImageManagerStatic::make(base64_decode((new DNS1D())->getBarcodePNG($request->barcode, 'C39E+')))
            ->encode('webp');
        \Storage::disk('public')->put('barcodes/'.$this->filename, $img);
        $this->filepath = \Storage::url('barcodes/'.$this->filename);
        Barcode::create(['filename' => $this->filename,
            'filepath' => $this->filepath,
            'text' => $request->barcode, ]);
    }
}
