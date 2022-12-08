<?php

namespace App\Repositories;

interface FileRepository
{
    public function create($request);

    public function getById($id);

    public function getAll();

    public function saveFilePathToRedis($id, $hash);

    public function getFilePathFromRedis($hash);

    public function deleteOlderRecords();
}
