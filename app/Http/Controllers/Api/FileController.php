<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;
use App\Http\Resources\FileCollection;
use App\Http\Resources\FileDetailResource;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileService;
use App\Utils\ResponseUtils;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /*
    Get a file by id
    */
    public function get(File $file)
    {
        $file = $this->fileService->get($file);

        return ResponseUtils::sendResponseWithSuccess('File found', new FileDetailResource($file), Response::HTTP_OK);
    }

    /*
    Get list of all files
    */
    public function getAll()
    {
        $files = $this->fileService->getAll();

        return new FileCollection($files);
    }

    /*
    Create a new file
    */
    public function create(StoreFileRequest $request)
    {
        $file = $this->fileService->save($request);

        if (! empty($file)) {
            return ResponseUtils::sendResponseWithSuccess('File saved successfully', new FileResource($file), Response::HTTP_CREATED);
        } else {
            return ResponseUtils::sendResponseWithError('Something went wrong, Unable to create quiz', Response::HTTP_UNAUTHORIZED);
        }
    }

    /*
    Get File from a temp url
     */
    public function getFile($file)
    {
        $pathToFile = $this->fileService->getFile($file);

        return response()->file($pathToFile);
    }
}
