<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\File\IFileRepository;
use App\Http\Requests\File\FileUploadRequest;
use App\Services\File\FileTempService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    public function __construct(
        IFileRepository $repository,
        private readonly FileTempService $fileService
    ) {
        $this->repository = $repository;
    }

    public function storeTempFile(FileUploadRequest $request): JsonResponse
    {
        return response()->json($this->fileService->storeTempFile($request->validated()));
    }

    public function servePendingFile(string $date, string $filename): Response
    {
        $path = $date . '/' . $filename;
        $disk = Storage::disk('pending');

        if (!$disk->exists($path)) {
            abort(404);
        }

        return response($disk->get($path), 200, [
            'Content-Type'  => $disk->mimeType($path),
            'Cache-Control' => 'no-store',
        ]);
    }

    public function delete(string $id): JsonResponse
    {
        $this->fileService->deleteFile($id);

        return $this->sendOkDeleted();
    }
}
