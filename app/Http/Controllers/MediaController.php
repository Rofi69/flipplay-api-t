<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::query()
            ->when($request->title, fn ($q, $title) => $q->where('title', 'like', "%{$title}%"))
            ->paginate(10);

        return MediaResource::collection($media);
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))->response()->setStatusCode(201);
    }

    public function show(Media $media)
    {
        return new MediaResource($media->load('users'));
    }

    public function update(StoreMediaRequest $request, Media $media)
    {
        $media->update($request->validated());

        return new MediaResource($media);
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json(['message' => 'Media berhasil dihapus']);
    }
}