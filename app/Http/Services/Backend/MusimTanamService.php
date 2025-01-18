<?php

namespace App\Http\Services\Backend;

use App\Models\MusimTanam;
use Illuminate\Support\Str;

class MusimTanamService
{
    public function select(){
        return MusimTanam::latest()->paginate(10);
    }
    public function getFirstBy(string $column, string $value)
    {
        return MusimTanam::where($column, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['nama'], '-');
        return MusimTanam::create($data);
    }

    public function update(array $data, string $uuid)
    {
        return MusimTanam::where('uuid', $uuid)->update($data);
    }

    public function delete(string $uuid)
    {
        return MusimTanam::where('uuid', $uuid)->delete();
    }
}
