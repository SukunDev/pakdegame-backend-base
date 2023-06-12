<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Models\Posts;
use App\Models\PostsView;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function getAllPost(Request $request)
    {
        $posts = Posts::whereNotNull("published_at")
            ->latest()
            ->filter([
                "category" => $request->category,
                "author" => $request->author,
                "tags" => $request->tags,
                "search" => $request->search,
            ])
            ->paginate(6);
        return response()->json([
            "success" => true,
            "result" => PostsResource::collection($posts)
                ->response()
                ->getData(true),
        ]);
    }

    public function singlePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "slug" => "required|string",
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    "success" => false,
                    "result" => $validator->errors(),
                ],
                404
            );
        }
        $post = Posts::whereNotNull("published_at")
            ->where("slug", $request->slug)
            ->first();
        if (!$post) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "posts not found",
                ],
                404
            );
        }
        if (!$post->showPost()) {
            $post->incrementViewsCount();
            PostsView::createViewLog($post);
        }
        $post->type = "singlePost";
        return response()->json([
            "success" => true,
            "result" => new PostsResource($post),
        ]);
    }
    public function createSiteMap(Request $request)
    {
        $posts = Posts::whereNotNull("published_at")

            ->latest()
            ->get();
        if (!$posts) {
            return response()->json([
                "success" => false,
                "message" => "posts not found",
            ]);
        }
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                "loc" => $post->slug,
                "lastmod" => $post->created_at->format("Y-m-d\TH:i:sP"),
            ];
        }
        return response()->json([
            "success" => true,
            "result" => $data,
        ]);
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Posts::class, "slug", $request->title);
        return response()->json(["slug" => $slug]);
    }
}
