<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkStorePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function bulkStore(BulkStorePostRequest $request){
        $bulk = collect($request->all())->map(function ($arr,$key){
            return $arr;
        });

        Post::insert($bulk->toArray());
    }

    public function postStore(StorePostRequest $request)
    {
        Post::created($request->toArray());
        return response()->json(PostCollection(Post::all()));
    }
}
