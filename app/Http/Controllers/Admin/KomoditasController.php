<?php

namespace App\Http\Controllers\admin;

use App\Models\Komoditas;
use App\Http\Controllers\Controller;
use App\Http\Requests\KomoditasRequest;
use App\Http\Services\Backend\KomoditasService;

class KomoditasController extends Controller
{
    public function __construct(
        private KomoditasService $komoditasService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.komoditas.index',[
            'komoditas' => $this->komoditasService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.komoditas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KomoditasRequest $request)
    {
        $data = $request->validated();

        try {
            $luasTanah = $this->komoditasService->create($data);

            return response()->json([
                'message' => 'Data Komoditas Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data Komoditas Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            return view('backend.komoditas.show', [
                'komoditas' => $this->komoditasService->getFirstBy('uuid', $uuid)
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
        return view('backend.komoditas.edit', [
            'komoditas' => $this->komoditasService->getFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KomoditasRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->komoditasService->getFirstBy('uuid', $uuid);

        try {
            $this->komoditasService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Komoditas Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $komoditas = $this->komoditasService->getFirstBy('uuid', $uuid, true);

        $this->komoditasService->delete($uuid);

        return response()->json(['message' => 'Data Komoditas Berhasil Dihapus...']);
    }
}
