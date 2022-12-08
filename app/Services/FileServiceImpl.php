<?php

namespace App\Services;

use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileServiceImpl implements FileService
{
    private FileRepository $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function get($file)
    {
        $tempFileHash = $this->getTempFileHash($file);
        $file->tempFileHash = $tempFileHash;

        $this->fileRepository->saveFilePathToRedis($file->id, $tempFileHash);

        return $file;
    }

    public function getAll()
    {
        $files = $this->fileRepository->getAll();

        return $files;
    }

    public function save($request)
    {
        // saving file in files folder
        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        // saving data in db using repo
        $fileData = [];
        $fileData['name'] = $request->name;
        $fileData['description'] = $request->description;
        $fileData['type'] = $request->type;
        $fileData['file'] = $fileName;

        $file = $this->fileRepository->create($fileData);

        return $file;
    }

    public function getFile($tempFileHash)
    {
        $fileIDFromRedis = $this->fileRepository->getFilePathFromRedis($tempFileHash);

        if (empty($fileIDFromRedis)) {
            abort(Response::HTTP_NOT_FOUND, 'File Not Found');
        }

        $file = $this->fileRepository->getById($fileIDFromRedis);

        if (empty($file)) {
            abort(Response::HTTP_NOT_FOUND, 'File Not Found');
        }

        $pathToFile = Storage::disk('local')->path('public/uploads/'.$file->file);

        if (! is_file($pathToFile)) {
            abort(Response::HTTP_NOT_FOUND, 'File Not Found');
        }

        return $pathToFile;
    }

    private function getTempFileHash($file)
    {
        $str = $file->id.'_'.time().'_'.$file->name;
        $hash = Hash::make($str);
        $hash = str_replace('/', '', $hash);

        return $hash;
    }
}
