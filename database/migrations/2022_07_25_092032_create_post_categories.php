<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        $postCategory = Config::get('alphanews.models.post_category');
        Schema::create('post_categories', static function (Blueprint $table) use ($postCategory) {
            $table->id();
            $table->string('name');
            $table->string('color', 15);
            $table->foreignId(Config::get('alphanews.foreign_keys.post_category_parent'))
                ->nullable()
                ->constrained((new $postCategory())->getTable())
            ;
            $table->unsignedInteger('posts_amount')->default(0);
            $table->unique(['name']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('post_categories', static function (Blueprint $table) {
            $table->dropForeign(
                'post_categories_'.Config::get('alphanews.foreign_keys.post_category_parent').'_foreign'
            );
        });
        Schema::dropIfExists('post_categories');
    }
};
