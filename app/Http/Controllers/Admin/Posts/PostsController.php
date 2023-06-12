<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Tags;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::latest()
            ->filter(request(["search", "category", "author", "tags"]))
            ->paginate(10)
            ->withQueryString();
        return view("admin.posts.index", [
            "title" => "Posts",
            "name" => "Semua Article",
            "posts" => $posts,
        ]);
    }

    public function write()
    {
        $categories = Categories::all();
        return view("admin.posts.write.index", [
            "title" => "Posts",
            "name" => "Tulis Article",
            "categories" => $categories,
        ]);
    }

    public function change(Posts $post)
    {
        $categories = Categories::all();
        return view("admin.posts.change.index", [
            "title" => "Posts",
            "name" => "Tulis Article",
            "posts" => $post,
            "categories" => $categories,
        ]);
    }

    public function categories(Request $request)
    {
        $categories = Categories::all();
        return view("admin.posts.categories.index", [
            "title" => "Posts",
            "name" => "Categories",
            "categories" => $categories,
        ]);
    }

    public function tags(Request $request)
    {
        $tags = Tags::all();
        return view("admin.posts.tags.index", [
            "title" => "Posts",
            "name" => "Tags",
            "tags" => $tags,
        ]);
    }

    public function postWrite(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "slug" => "required|unique:posts",
            "body" => "required",
            "thumbnail" => "required",
            "meta_description" => "required",
        ]);
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["thumbnail"] = "";
        $validatedData["meta_keyword"] = $request->tags;
        $validatedData["category_id"] = $request->category_id;
        if ($request->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $filename = $file->getClientOriginalName();
            $file->move(public_path("image/thumbnail/"), $filename);
            $validatedData["thumbnail"] = asset("image/thumbnail/" . $filename);
        }
        $validatedData["excerpt"] = Str::limit(
            strip_tags($request->body),
            200,
            "..."
        );
        if ($request->status == "publish") {
            $validatedData["published_at"] = now();
        } else {
            $validatedData["published_at"] = null;
        }
        $post = Posts::create($validatedData);
        if (!$post) {
            return back()->with([
                "status" => "error",
                "message" => 'Gagal Meyimpan Artikel", "Failed',
            ]);
        }
        $tagIds = [];
        if (!empty($request->get("tags"))) {
            foreach (explode(",", $request->get("tags")) as $tagName) {
                $tag = Tags::where("name", ltrim($tagName))->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                } else {
                    $tagIds[] = Tags::create([
                        "name" => ltrim($tagName),
                        "slug" => SlugService::createSlug(
                            Tags::class,
                            "slug",
                            ltrim($tagName)
                        ),
                    ])->id;
                }
            }
        }
        $post->tags()->sync($tagIds);
        return redirect("/ngadmin/posts")->with([
            "status" => "success",
            "message" => 'Berhasil Meyimpan Artikel", "Success',
        ]);
    }
    public function postChange(Request $request, Posts $post)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "slug" => "required|unique:posts,user_id," . auth()->user()->id,
            "body" => "required",
            "meta_description" => "required",
        ]);
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["meta_keyword"] = $request->tags;
        $validatedData["category_id"] = $request->category_id;
        if ($request->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $filename = $file->getClientOriginalName();
            $file->move(public_path("image/thumbnail/"), $filename);
            $validatedData["thumbnail"] = asset("image/thumbnail/" . $filename);
        }
        $validatedData["excerpt"] = Str::limit(
            strip_tags($request->body),
            200,
            "..."
        );
        if ($request->status == "publish") {
            $validatedData["published_at"] = now();
        } else {
            $validatedData["published_at"] = null;
        }
        $post = Posts::find($post->id);
        if (!$post) {
            return back()->with([
                "status" => "error",
                "message" => 'Gagal Meyimpan Artikel", "Failed',
            ]);
        }
        $post->update($validatedData);
        $tagIds = [];
        if (!empty($request->get("tags"))) {
            foreach (explode(",", $request->get("tags")) as $tagName) {
                $tag = Tags::where("name", ltrim($tagName))->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                } else {
                    $tagIds[] = Tags::create([
                        "name" => ltrim($tagName),
                        "slug" => SlugService::createSlug(
                            Tags::class,
                            "slug",
                            ltrim($tagName)
                        ),
                    ])->id;
                }
            }
        }
        $post->tags()->sync($tagIds);
        return redirect("/ngadmin/posts")->with([
            "status" => "success",
            "message" => 'Berhasil Meyimpan Artikel", "Success',
        ]);
    }

    public function postDelete($id)
    {
        $deltePost = Posts::find($id);
        if ($deltePost) {
            $deltePost->tags()->sync([]);
            $deltePost->delete();
            return back()->with([
                "status" => "success",
                "message" => 'Berhasil Menghapus Artikel", "Success',
            ]);
        }
        return back()->with([
            "status" => "error",
            "message" => 'Gagal Menghapus Artikel", "Failed',
        ]);
    }

    public function postCreateCategory(Request $request)
    {
        $request->validate([
            "name" => "required|unique:categories",
        ]);
        $slug = SlugService::createSlug(
            Categories::class,
            "slug",
            $request->name
        );
        $checkCategory = Categories::where("slug", $slug);
        if ($checkCategory->count() < 1) {
            Categories::create(["name" => $request->name, "slug" => $slug]);
            return back()->with([
                "status" => "success",
                "message" => 'Berhasil Membuat Category", "Success',
            ]);
        }
        return back()->with([
            "status" => "error",
            "message" => 'Gagal Membuat Artikel", "Failed',
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return back()->with([
                "status" => "success",
                "message" => 'Berhasil Menghapus Category", "Success',
            ]);
        }
        return back()->with([
            "status" => "error",
            "message" => 'Gagal Menghapus Category", "Failed',
        ]);
    }

    public function deleteTags($id)
    {
        $tags = Tags::find($id);
        if ($tags) {
            foreach ($tags->posts as $post) {
                $tagIds = [];
                $metaKeyword = [];
                foreach ($post->tags as $tag) {
                    if ($tag->id != $id) {
                        $tagIds[] = $tag->id;
                        $metaKeyword[] = $tag->name;
                    }
                }
                $post->update([
                    "meta_keyword" => join(", ", $metaKeyword),
                ]);
                $post->tags()->sync($tagIds);
            }
            $tags->delete();
            return back()->with([
                "status" => "success",
                "message" => 'Berhasil Menghapus Tags", "Success',
            ]);
        }
        return back()->with([
            "status" => "error",
            "message" => 'Gagal Menghapus Tags", "Failed',
        ]);
    }
}
