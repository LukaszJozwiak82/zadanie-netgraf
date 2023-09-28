<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BarcodeRequest;
use App\Models\Barcode;
use App\Services\BarcodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BarcodeController extends Controller
{
    private $barcodeService;

    public function __construct(BarcodeService $barcodeService)
    {
        $this->barcodeService = $barcodeService;
    }

    public function index(): View
    {
        $barcodes = Barcode::orderBy('id', 'desc')->get();

        return view('index', ['barcodes' => $barcodes]);
    }

    public function generate(BarcodeRequest $request): RedirectResponse
    {

        $this->barcodeService->generateBarcode($request);

        return redirect()->route('barcode.index')->with('success', 'Barcode created successfully!');
    }
}
