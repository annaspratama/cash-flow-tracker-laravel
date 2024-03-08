<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Services\UploadImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    private UploadImageService $uploadImageService;

    /**
     * Control all upload image requests.
     * 
     * @param UserService $userService
     */
    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    /**
     * Upload an profile image.
     * 
     * @param UploadImageRequest $request
     * 
     * @return JsonResponse
     */
    public function uploadProfileImage(UploadImageRequest $request): JsonResponse
    {
        return $this->uploadImageService->uploadImage(request: $request);
    }

    /**
     * Custom controller function for supporting test case.
     * 
     * @param UploadImageRequest $request
     * @return bool
     */
    public function testUploadImage(UploadImageRequest $request): JsonResponse
    {
        return $this->uploadImageService->uploadImage(request: $request);
    }
}
