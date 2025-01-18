<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LuasTanahRequest;
use App\Http\Services\Backend\LuasTanahService;

class LuasTanahController extends Controller
{

    public function __construct(
        private LuasTanahService $luasTanahService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.luas-tanah.index',[
            'luasTanahs' => $this->luasTanahService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.luas-tanah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LuasTanahRequest $request)
    {
        $data = $request->validated();

        try {
            $luasTanah = $this->luasTanahService->create($data);

            return response()->json([
                'message' => 'Data Luas Tanah Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data Luas Tanah Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $uuid)
    {
        try {
            return view('backend.luas-tanah.show', [
                'luasTanah' => $this->luasTanahService->getFirstBy('uuid', $uuid)
            ]);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $uuid)
    {
        return view('backend.luas-tanah.edit', [
            'luasTanah' => $this->luasTanahService->getFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LuasTanahRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getData = $this->luasTanahService->getFirstBy('uuid', $uuid);

        try {
            $this->luasTanahService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Luas Tanah Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $luasTanah = $this->luasTanahService->getFirstBy('uuid', $uuid, true);

        $this->luasTanahService->delete($uuid);

        return response()->json(['message' => 'Data Luas Tanah Berhasil Dihapus...']);
    }
}
