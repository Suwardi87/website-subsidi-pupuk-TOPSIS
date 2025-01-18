<?php

namespace App\Http\Services\Backend;

use App\Models\Komoditas;
use Illuminate\Support\Str;

class KomoditasService
{
    public function select(){
        return Komoditas::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value)
    {
        return Komoditas::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['nama'], '-');
        return Komoditas::create($data);
    }

    public function update(array $data, string $uuid)
    {
        return Komoditas::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return Komoditas::where('uuid', $uuid)->delete();
    }
}
