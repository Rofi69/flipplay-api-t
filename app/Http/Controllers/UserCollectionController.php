<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserCollectionController extends Controller
{
    public function index(User $user)
    {
        return MediaResource::collection($user->media);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'media_id' => 'required|integer|exists:media,id',
        ]);

        if ($user->media()->where('media_id', $request->media_id)->exists()) {
            return response()->json(['message' => 'Media sudah ada di koleksi'], 409);
        }

        $user->media()->attach($request->media_id);

        return response()->json(['message' => 'Media berhasil ditambahkan ke koleksi'], 201);
    }

    public function destroy(User $user, Media $media)
    {
        if (! $user->media()->where('media_id', $media->id)->exists()) {
            return response()->json(['message' => 'Media tidak ada di koleksi'], 404);
        }

        $user->media()->detach($media->id);

        return response()->json(['message' => 'Media berhasil dihapus dari koleksi']);
    }
}