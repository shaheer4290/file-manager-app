<?php

namespace App\Services;

interface FileService
{
    public function get($file);

    public function save($request);

    public function getFile($tempFileHash);
}
