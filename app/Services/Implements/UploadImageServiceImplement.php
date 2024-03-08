<?php

namespace App\Services\Implements;

use App\Http\Requests\UploadImageRequest;
use App\Services\UploadImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UploadImageServiceImplement implements UploadImageService
{
    public function uploadImage(UploadImageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $urlPath = 'public/user-images';
        $imageName = time().'.'.$data['profile_image']->extension();
        // $request->image->move(public_path($urlPath), $imageName);
        $imgPath = Storage::putFileAs(path: $urlPath, file: $data['profile_image'], name: $imageName);
        $imgUrl = Storage::url(path: $imgPath);

        $user = $request->user();
        $user->profile_image = $imgUrl;
        $user->save();

        return response()->json(data: [
            'data' => [
                'image_path' => $user->profile_image
            ]
        ], status: 200);
    }
}