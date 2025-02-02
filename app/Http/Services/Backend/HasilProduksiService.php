<?php

namespace App\Http\Services\Backend;

use App\Models\HasilProduksi;
use Illuminate\Support\Str;

class HasilProduksiService
{
    public function select(){
        return HasilProduksi::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value)
    {
        return HasilProduksi::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['hasil_produksi'], '-');
        return HasilProduksi::create($data);
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['hasil_produksi'], '-');
        return HasilProduksi::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return HasilProduksi::where('uuid', $uuid)->delete();
    }
}
