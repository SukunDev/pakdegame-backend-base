<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Pages::latest()->paginate(10);
        return view("admin.pages.index", [
            "title" => "Pages",
            "name" => "Semua Halaman",
            "pages" => $pages,
        ]);
    }
    public function write()
    {
        return view("admin.pages.write.index", [
            "title" => "Pages",
            "name" => "Tulis Halaman",
        ]);
    }
    public function change(Pages $page)
    {
        return view("admin.pages.change.index", [
            "title" => "Pages",
            "name" => "Edit Halaman",
            "pages" => $page,
        ]);
    }
    public function postWrite(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "slug" => "required|unique:pages",
            "body" => "required",
        ]);
        if ($request->status == "publish") {
            $validatedData["published_at"] = now();
        } else {
            $validatedData["published_at"] = null;
        }
        $validatedData["user_id"] = auth()->user()->id;
        $pages = Pages::create($validatedData);
        if (!$pages) {
            return back()->with([
                "status" => "error",
                "message" => 'Gagal Meyimpan Halaman", "Failed',
            ]);
        }
        return redirect("/ngadmin/pages")->with([
            "status" => "success",
            "message" => 'Berhasil Meyimpan Halaman", "Success',
        ]);
    }
    public function postChange(Request $request, Pages $page)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "slug" => "required|unique:pages,user_id," . auth()->user()->id,
            "body" => "required",
        ]);
        if ($request->status == "publish") {
            $validatedData["published_at"] = now();
        } else {
            $validatedData["published_at"] = null;
        }
        $page->update($validatedData);
        if (!$page) {
            return back()->with([
                "status" => "error",
                "message" => 'Gagal Mengubah Halaman", "Failed',
            ]);
        }
        return redirect("/ngadmin/pages")->with([
            "status" => "success",
            "message" => 'Berhasil Mengubah Halaman", "Success',
        ]);
    }
    public function deletePages($id)
    {
        $pages = Pages::find($id);
        $pages->delete();
        return back()->with([
            "status" => "success",
            "message" => 'Berhasil Menghapus Halaman", "Success',
        ]);
    }
}
