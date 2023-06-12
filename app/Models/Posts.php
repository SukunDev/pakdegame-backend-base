<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "posts";
    protected $guarded = ["id"];
    protected $with = ["user", "category", "tags"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters["search"] ?? false,
            fn($query, $search) => $query->where(
                "title",
                "like",
                "%" . $search . "%"
            )
        );
        $query->when(
            $filters["category"] ?? false,
            fn($query, $category) => $query->whereHas(
                "category",
                fn($query) => $query->where("slug", $category)
            )
        );
        $query->when(
            $filters["author"] ?? false,
            fn($query, $user) => $query->whereHas(
                "user",
                fn($query) => $query->where("username", $user)
            )
        );
        $query->when(
            $filters["tags"] ?? false,
            fn($query, $tags) => $query->whereHas(
                "tags",
                fn($query) => $query->where("slug", $tags)
            )
        );
    }
    public function incrementViewsCount()
    {
        $this->views_count++;
        return $this->save();
    }
    public function postsView()
    {
        return $this->hasMany(PostsView::class);
    }
    public function showPost()
    {
        return $this->postsView()
            ->where("ip", "=", request()->ip())
            ->whereDate("created_at", Carbon::today())
            ->exists();
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
            ],
        ];
    }
}
