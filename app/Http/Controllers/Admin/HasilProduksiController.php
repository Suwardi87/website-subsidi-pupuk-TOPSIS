<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HasilProduksiRequest;
use App\Http\Services\Backend\HasilProduksiService;

class HasilProduksiController extends Controller
{
    public function __construct(
        private HasilProduksiService $hasilProduksiService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.hasil-produksi.index',[
            'hasilProduksis' => $this->hasilProduksiService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.hasil-produksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HasilProduksiRequest $request)
    {
        $data = $request->validated();

        try {
            $hasilProduksi = $this->hasilProduksiService->create($data);

            return response()->json([
                'message' => 'Data Hasil Produksi Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data Hasil Produksi Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            return view('backend.hasil-produksi.show', [
                'hasilProduksi' => $this->hasilProduksiService->getFirstBy('uuid', $uuid)
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
        return view('backend.hasil-produksi.edit', [
            'hasilProduksi' => $this->hasilProduksiService->getFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HasilProduksiRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->hasilProduksiService->getFirstBy('uuid', $uuid);

        try {
            $this->hasilProduksiService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Musim Tanam Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $hasilProduksi = $this->hasilProduksiService->getFirstBy('uuid', $uuid, true);

        $this->hasilProduksiService->delete($uuid);

        return response()->json(['message' => 'Data Musim Tanam Berhasil Dihapus...']);

    }
}
