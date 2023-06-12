<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("posts", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->text("excerpt");
            $table->text("body");
            $table->string("thumbnail");
            $table->foreignId("category_id")->nullable();
            $table->foreignId("user_id")->constrained("users");
            $table
                ->bigInteger("views_count")
                ->unsigned()
                ->default(0)
                ->index();
            $table->text("meta_keyword");
            $table->text("meta_description");
            $table->timestamp("published_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("posts");
    }
};
