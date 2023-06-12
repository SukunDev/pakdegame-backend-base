<?php

namespace App\Http\Controllers\Blog\Pages;

use App\Http\Controllers\Controller;
use App\Http\Resources\PagesResource;
use App\Models\Pages;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function singlePage(Request $request)
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
        $page = Pages::whereNotNull("published_at")
            ->where("slug", $request->slug)
            ->first();
        if (!$page) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "pages not found",
                ],
                404
            );
        }
        return response()->json([
            "success" => true,
            "result" => new PagesResource($page),
        ]);
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pages::class, "slug", $request->title);
        return response()->json(["slug" => $slug]);
    }
}
