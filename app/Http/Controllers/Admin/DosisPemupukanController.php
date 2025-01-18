<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\DosisPemupukan;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosisPemupukanRequest;
use App\Http\Services\Backend\KomoditasService;
use App\Http\Services\Backend\MusimTanamService;
use App\Http\Services\Backend\DosisPemupukanService;

class DosisPemupukanController extends Controller
{
    public function __construct(
        private DosisPemupukanService $dosisPemupukanService,
        private KomoditasService $komoditasService,
        private MusimTanamService $musimTanamService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.dosis-pemupukan.index',[
            'dosisPemupukans' => $this->dosisPemupukanService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komoditas = $this->komoditasService->select();
        $musimTanam = $this->musimTanamService->select();
        return view('backend.dosis-pemupukan.create',[
            'komoditass' => $komoditas,
            'musimTanams' => $musimTanam
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DosisPemupukanRequest $request)
    {
        $data = $request->validated();

        try {
            $dosisPemupukan = $this->dosisPemupukanService->create($data);
            return response()->json([
                'message' => 'Data Dosis Pemupukan Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data Dosis Pemupukan Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            return view('backend.dosis-pemupukan.show', [
                'dosisPemupukan' => $this->dosisPemupukanService->getFirstBy('uuid', $uuid)
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
        return view('backend.dosis-pemupukan.edit', [
            'dosisPemupukan' => $this->dosisPemupukanService->getFirstBy('uuid', $uuid, true),
            'komoditass' => $this->komoditasService->select(),
            'musimTanams' => $this->musimTanamService->select()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DosisPemupukanRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->dosisPemupukanService->getFirstBy('uuid', $uuid, true);

        try {
            $this->dosisPemupukanService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Dosis Pemupukan Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $dosisPemupukan = $this->dosisPemupukanService->getFirstBy('uuid', $uuid, true);

        $this->dosisPemupukanService->delete($uuid);

        return response()->json(['message' => 'Data Dosis Pemupukan Berhasil Dihapus...']);
    }
}
