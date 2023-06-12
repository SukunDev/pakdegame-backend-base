<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsView extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    public static function createViewLog($post)
    {
        $postViews = new PostsView();
        $postViews->posts_id = $post->id;
        $postViews->slug = $post->slug;
        $postViews->session_id = request()
            ->getSession()
            ->getId();
        $postViews->ip = request()->ip();
        $postViews->agent = request()->header("User-Agent");
        $postViews->save();
    }
}
