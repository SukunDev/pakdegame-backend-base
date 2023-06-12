<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Pages\PagesController as AdminPagesController;
use App\Http\Controllers\Admin\Posts\PostsController as AdminPostsController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\Options\OptionsController;
use App\Http\Controllers\Blog\Pages\PagesController;
use App\Http\Controllers\Blog\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return abort(404);
});

Route::group(["prefix" => "blog"], function () {
    Route::get("posts", [PostsController::class, "getAllPost"]);
    Route::post("posts", [PostsController::class, "singlePost"]);
    Route::get("check-slug", [PostsController::class, "checkSlug"]);
    Route::get("sitemap", [PostsController::class, "createSiteMap"]);
    Route::post("pages", [PagesController::class, "singlePage"]);
    Route::get("page/check-slug", [PagesController::class, "checkSlug"]);
    Route::get("options", [OptionsController::class, "getOptions"]);
});

Route::get("/auth/signin", [AuthController::class, "index"])->middleware(
    "guest"
);
Route::post("/auth/signin", [AuthController::class, "signinPosts"]);
Route::post("/auth/signout", [AuthController::class, "signout"]);

Route::group(["prefix" => "ngadmin", "middleware" => ["auth"]], function () {
    Route::get("/", [DashboardController::class, "index"]);
    Route::group(["prefix" => "posts"], function () {
        Route::get("/", [AdminPostsController::class, "index"]);
        Route::get("/write", [AdminPostsController::class, "write"]);
        Route::post("/write", [AdminPostsController::class, "postWrite"]);
        Route::get("/change/{post:slug}", [
            AdminPostsController::class,
            "change",
        ]);
        Route::post("/change/{post:slug}", [
            AdminPostsController::class,
            "postChange",
        ]);
        Route::get("/delete/{id}", [AdminPostsController::class, "postDelete"]);
        Route::get("/categories", [AdminPostsController::class, "categories"]);
        Route::post("/categories/create", [
            AdminPostsController::class,
            "postCreateCategory",
        ]);
        Route::get("/categories/delete/{id}", [
            AdminPostsController::class,
            "deleteCategory",
        ]);
        Route::get("/tags", [AdminPostsController::class, "tags"]);
        Route::get("/tags/delete/{id}", [
            AdminPostsController::class,
            "deleteTags",
        ]);
        Route::group(
            [
                "prefix" => "laravel-filemanager",
                "middleware" => ["web"],
            ],
            function () {
                \UniSharp\LaravelFilemanager\Lfm::routes();
            }
        );
    });
    Route::group(["prefix" => "pages"], function () {
        Route::get("/", [AdminPagesController::class, "index"]);
        Route::get("/write", [AdminPagesController::class, "write"]);
        Route::post("/write", [AdminPagesController::class, "postWrite"]);
        Route::get("/change/{page:slug}", [
            AdminPagesController::class,
            "change",
        ]);
        Route::post("/change/{page:slug}", [
            AdminPagesController::class,
            "postChange",
        ]);
        Route::get("/delete/{id}", [
            AdminPagesController::class,
            "deletePages",
        ]);
    });
    Route::get("/settings", [SettingsController::class, "index"]);
});
