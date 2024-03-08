<?php
/**
 * Image service is upload image management functions.
 * 
 * @author  Annas Pratama
 * @since   2024
 * @version 1.0.0
 */

namespace App\Services;

use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Response;

interface UploadImageService
{
    /**
     * Save an image then return as path.
     * 
     * @param UploadImageRequest $request
     * 
     * @throws Illuminate\Http\Exceptions\HttpResponseException
     * @return JsonResponse
     */
    public function uploadImage(UploadImageRequest $request): JsonResponse;
}