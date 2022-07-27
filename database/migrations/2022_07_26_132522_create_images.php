<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

return new class extends Migration {
    public function up(): void
    {
        $mediaFolderTable = Config::get('alphanews.models.media_folder');
        Schema::create('images', static function (Blueprint $table) use ($mediaFolderTable) {
            $table->id();
            $table->string('name');
            $table->foreignId(Config::get('alphanews.foreign_keys.media_folder'));
            $table->foreign(Config::get('alphanews.foreign_keys.media_folder'))
                ->references('id')
                ->on((new $mediaFolderTable)->getTable());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('images', static function (Blueprint $table) {
            $table->dropForeign('images_'. Config::get('alphanews.foreign_keys.media_folder').'_foreign');
        });
        Schema::dropIfExists('images');
    }
};
