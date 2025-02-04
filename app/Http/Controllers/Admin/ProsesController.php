<?php

namespace App\Http\Controllers\admin;

use App\Models\Proses;
use Illuminate\Http\Request;
use Matrix\Decomposition\LU;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProsesRequest;
use App\Http\Services\Backend\ProsesService;
use App\Http\Services\Backend\HasilProduksiService;
use App\Http\Services\Backend\LuasTanahService;
use App\Http\Services\Backend\ProduksiService;
use App\Http\Services\Backend\DosisPemupukanService;

class ProsesController extends Controller
{
    public function __construct(
        private DosisPemupukanService $dosisPemupukanService,
        private LuasTanahService $luasTanahService,
        private HasilProduksiService $HasilProduksiService,
        private ProduksiService $ProduksiService,
        private DosisPemupukanController $dosisPemupukanController,
        private ProsesService $prosesService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.proses.index', [
            'proses' => $this->prosesService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = $this->prosesService->getUser();
        return view('backend.proses.create', [
            'users' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProsesRequest $request)
    {
        $data = $request->validated();
        try {
            $proses = $this->prosesService->create($data);
            return response()->json([
                'message' => 'Data Petani Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Data Petani Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $uuid)
    {
        try {
            return view('backend.proses.show', [
                'proses' => $this->prosesService->getFirstBy('uuid', $uuid)
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
        return view('backend.proses.edit', [
            'proses' => $this->prosesService->getFirstBy('uuid', $uuid, true),
            'users' => $this->prosesService->getUser(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProsesRequest $request, String $uuid)
    {
        $data = $request->validated();

        $getData = $this->prosesService->getFirstBy('uuid', $uuid, true);

        try {
            $this->prosesService->update($data, $getData->uuid);

            return response()->json(['message' => 'Data Petani Berhasil Diubah!']);
        } catch (\Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $uuid)
    {
        $proses = $this->prosesService->getFirstBy('uuid', $uuid, true);

        $this->prosesService->delete($uuid);

        return response()->json(['message' => 'Data Petani Berhasil Dihapus...']);
    }

    public function verifikasi(Request $request, $uuid)
    {
        $data = $request->validate([
            'verifikasi' => 'required|in:setuju,tolak',
        ]);

        try {
            $proses = Proses::where('uuid', $uuid)->firstOrFail();
            $proses->verifikasi = $data['verifikasi'];
            $proses->save();

            return response()->json(['message' => 'Status verifikasi berhasil diubah']);
        } catch (\Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }



    public function topsis()
    {
        $data = Proses::with('user:id,name', 'komoditas:id,nama,bobot', 'musimTanam:id,nama,bobot')->get();

        $matriksKeputusan = $data->map(function ($item) {
            return [
                'luas_lahan' => $item->luas_lahan,
                'dosis_pemupukan' => $item->dosis_pemupukan,
                'komoditas' => $item->komoditas->nilai,
                'musim_tanam' => $item->musimTanam->nilai,
            ];
        })->toArray();

        $bobot = $this->getBobot();
        $normalisasi = $this->normalisasiMatriks($matriksKeputusan);
        $terbobot = $this->bobotMatriks($normalisasi, $bobot);
        $ideal = $this->tentukanIdeal($terbobot);
        $preferensi = $this->hitungPreferensi($terbobot, $ideal);

        return view('backend.proses.topsis', compact('data', 'normalisasi', 'terbobot', 'ideal', 'preferensi'));
    }


    private function getBobot()
    {
        return [
            'luas_lahan' => 0.4,
            'dosis_pemupukan' => 0.3,
            'komoditas' => 0.2,
            'musim_tanam' => 0.1,
        ];
    }

    private function normalisasiMatriks($matriks)
    {
        $result = [];
        foreach ($matriks as $key => $row) {
            $result[$key] = array_map(function ($val, $col) use ($matriks) {
                $columnSum = sqrt(array_sum(array_column($matriks, $col)));
                return $val / $columnSum;
            }, $row, array_keys($row));
        }
        return $result;
    }

    private function bobotMatriks($matriks, $bobot)
    {
        return array_map(function ($row) use ($bobot) {
            return array_map(function ($val, $b) {
                return $val * $b;
            }, $row, $bobot);
        }, $matriks);
    }

    private function tentukanIdeal($terbobot)
    {
        $positif = array_map('max', array_map(null, ...$terbobot));
        $negatif = array_map('min', array_map(null, ...$terbobot));
        return compact('positif', 'negatif');
    }

    private function hitungPreferensi($terbobot, $ideal)
    {
        return array_map(function ($row) use ($ideal) {
            $dPositif = sqrt(array_sum(array_map(function ($val, $ideal) {
                return pow($val - $ideal, 2);
            }, $row, $ideal['positif'])));

            $dNegatif = sqrt(array_sum(array_map(function ($val, $ideal) {
                return pow($val - $ideal, 2);
            }, $row, $ideal['negatif'])));

            return $dNegatif / ($dPositif + $dNegatif);
        }, $terbobot);
    }
}
