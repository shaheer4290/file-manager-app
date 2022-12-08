<?php

namespace App\Repositories;

use App\Models\File;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class FileRepositoryImpl implements FileRepository
{
    public function create($data) {
        return File::create($data);
    }

    public function getById($id) {
        return File::find($id);
    }

    public function getAll() {
        return File::paginate(10);
    }

    public function saveFilePathToRedis($id, $hash)
    {
        $key = 'file-'.$hash;
        Redis::setex($key, 600, $id);
    }

    public function getFilePathFromRedis($hash)
    {
        $key = 'file-'.$hash;

        return Redis::get($key);
    }

    public function deleteOlderRecords() {
        $files = File::whereDate('created_at', '<=', now()->subDays(30))->delete();

        return $files;
    }
}