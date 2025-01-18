<?php

namespace App\Http\Services\Backend;

use App\Models\LuasTanah;

class LuasTanahService
{
    public function select(){
        return LuasTanah::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value)
    {
        return LuasTanah::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        return LuasTanah::create($data);
    }

    public function update(array $data, string $uuid)
    {
        return LuasTanah::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return LuasTanah::where('uuid', $uuid)->delete();
    }
}
