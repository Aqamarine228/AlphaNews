<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        $post = Config::get('alphanews.models.post');
        $tag = Config::get('alphanews.models.tag');
        Schema::create('post_tag', static function (Blueprint $table) use ($post, $tag) {
            $table->foreignId(Config::get('alphanews.foreign_keys.tag'));
            $table->foreignId(Config::get('alphanews.foreign_keys.post'));
            $table->foreign(Config::get('alphanews.foreign_keys.tag'))
                ->references('id')
                ->on((new $tag())->getTable())
            ;
            $table->foreign(Config::get('alphanews.foreign_keys.post'))
                ->references('id')
                ->on((new $post())->getTable())
            ;
            $table->unique([
                Config::get('alphanews.foreign_keys.tag'),
                Config::get('alphanews.foreign_keys.post'),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('post_tag', static function (Blueprint $table) {
            $table->dropForeign('post_tag_'.Config::get('alphanews.foreign_keys.tag').'_foreign');
            $table->dropForeign('post_tag_'.Config::get('alphanews.foreign_keys.post').'_foreign');
        });
        Schema::dropIfExists('post_tag');
    }
};
