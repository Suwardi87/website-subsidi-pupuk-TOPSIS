<?php

namespace App\Http\Services\Backend;

use Illuminate\Support\Str;
use App\Models\DosisPemupukan;

class DosisPemupukanService
{
    public function select(){
        return DosisPemupukan::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        return DosisPemupukan::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['dosis_pemupukan'], '-');
        return DosisPemupukan::create($data);
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['dosis_pemupukan'], '-');
        return DosisPemupukan::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return DosisPemupukan::where('uuid', $uuid)->delete();
    }
}
