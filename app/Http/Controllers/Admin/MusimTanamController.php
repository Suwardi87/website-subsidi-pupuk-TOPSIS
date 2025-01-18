<?php

namespace App\Http\Controllers\admin;

use App\Models\MusimTanam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MusimTanamRequest;
use App\Http\Services\Backend\MusimTanamService;

class MusimTanamController extends Controller
{
    public function __construct(
        private MusimTanamService $musimTanamService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.musim-tanam.index',[
            'musimTanams' => $this->musimTanamService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.musim-tanam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MusimTanamRequest $request)
    {
        $data = $request->validated();

        try {
            $musimTanam = $this->musimTanamService->create($data);

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
            return view('backend.musim-tanam.show', [
                'musimTanam' => $this->musimTanamService->getFirstBy('uuid', $uuid)
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
        return view('backend.musim-tanam.edit', [
            'musimTanam' => $this->musimTanamService->getFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MusimTanamRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->musimTanamService->getFirstBy('uuid', $uuid);

        try {
            $this->musimTanamService->update($data, $getData->uuid);

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
        $dosisPemupukan = $this->musimTanamService->getFirstBy('uuid', $uuid, true);

        $this->musimTanamService->delete($uuid);

        return response()->json(['message' => 'Data Musim Tanam Berhasil Dihapus...']);

    }
}
