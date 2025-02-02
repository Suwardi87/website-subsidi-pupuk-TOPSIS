<?php

namespace App\Http\Services\Backend;

use App\Models\Produksi;
use Illuminate\Support\Str;

class ProduksiService
{
    public function select(){
        return Produksi::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value)
    {
        return Produksi::where($column, $value)->firstOrFail();
    }

/*************  ✨ Codeium Command 🌟  *************/
    public function create(array $data)
    {
       
        $data['slug'] = Str::slug($data['biaya_produksi'], '-');
        return Produksi::create($data);
    }

    public function update(array $data, string $uuid)
    {
        return Produksi::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return Produksi::where('uuid', $uuid)->delete();
    }
}
