<?php

use Aqamarine\AlphaNews\Enums\PostMediaType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        $user = Config::get('alphanews.models.user');
        $postCategory = Config::get('alphanews.models.post_category');

        Schema::create('posts', static function (Blueprint $table) use ($user, $postCategory) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('picture')->nullable();
            $table->string('short_title')->nullable();
            $table->string('short_content')->nullable();
            $table->enum('media_type', collect(PostMediaType::cases())->pluck('value')->toArray())
                ->nullable();
            $table->foreignId(Config::get('alphanews.foreign_keys.post_category'))->nullable();
            $table->foreign(Config::get('alphanews.foreign_keys.post_category'))
                ->references('id')
                ->on((new $postCategory())->getTable())
            ;
            $table->foreignId(Config::get('alphanews.foreign_keys.user'));
            $table->foreign(Config::get('alphanews.foreign_keys.user'))
                ->references('id')
                ->on((new $user())->getTable())
            ;
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->boolean('is_trending_now')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('posts', static function (Blueprint $table) {
            $table->dropForeign('posts_'.Config::get('alphanews.foreign_keys.user').'_foreign');
            $table->dropForeign('posts_'.Config::get('alphanews.foreign_keys.post_category').'_foreign');
        });
        Schema::dropIfExists('posts');
    }
};
