<?php

namespace App\Http\Services\Backend;

use App\Models\LuasTanah;
use Illuminate\Support\Str;

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
        $data['slug'] = Str::slug($data['luas_lahan'], '-');
        return LuasTanah::create($data);
    }

    public function update(array $data, string $uuid)
    {
        $data['slug'] = Str::slug($data['luas_lahan'], '-');
        return LuasTanah::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return LuasTanah::where('uuid', $uuid)->delete();
    }
}
