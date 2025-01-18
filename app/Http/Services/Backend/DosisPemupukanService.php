<?php

namespace App\Http\Services\Backend;

use App\Models\DosisPemupukan;

class DosisPemupukanService
{
    public function select(){
        return DosisPemupukan::latest()
        ->with('komoditas:id,nama', 'musimTanam:id,nama')
        ->paginate(10);
    }
    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        if ($relation == true ) {
            return DosisPemupukan::with('komoditas:id,nama', 'musimTanam:id,nama')->where($column, $value)->firstOrFail();
        } elseif ($relation == false ) {
            return DosisPemupukan::where($column, $value)->firstOrFail();
        } else {
            return DosisPemupukan::where($column, $value)->firstOrFail();
        }
    }

    public function create(array $data)
    {
        return DosisPemupukan::create($data);
    }

    public function update(array $data, string $uuid)
    {
        return DosisPemupukan::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return DosisPemupukan::where('uuid', $uuid)->delete();
    }
}
