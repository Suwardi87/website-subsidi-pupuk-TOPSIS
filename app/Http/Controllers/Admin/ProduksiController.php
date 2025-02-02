<?php

namespace App\Http\Controllers\admin;

use App\Models\produksi;
use App\Http\Controllers\Controller;
use App\Http\Requests\produksiRequest;
use App\Http\Services\Backend\ProduksiService;

class ProduksiController extends Controller
{
    public function __construct(
        private ProduksiService $produksiService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.biaya-produksi.index',[
            'biayaProduksi' => $this->produksiService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.biaya-produksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProduksiRequest $request)
    {
        $data = $request->validated();
        try {
            $produksi = $this->produksiService->create($data);
            return response()->json([
                'message' => 'Data Biaya Produksi Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data BIaya Produksi Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            return view('backend.biaya-produksi.show', [
                'biayaProduksi' => $this->produksiService->getFirstBy('uuid', $uuid)
            ]);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.biaya-produksi.edit', [
            'biayaProduksi' => $this->produksiService->getFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProduksiRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->produksiService->getFirstBy('uuid', $uuid);

        try {
            $this->produksiService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Biaya Produksi Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $produksi = $this->produksiService->getFirstBy('uuid', $uuid, true);

        $this->produksiService->delete($uuid);

        return response()->json(['message' => 'Data Biaya Produksi Berhasil Dihapus...']);
    }
}
