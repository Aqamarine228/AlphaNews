<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

return new class extends Migration {
    public function up(): void
    {
        $mediaFolderModel = Config::get('alphanews.models.media_folder');
        Schema::create('media_folders', static function (Blueprint $table) use ($mediaFolderModel) {
            $table->id();
            $table->string('name');
            $table->foreignId(Config::get('alphanews.foreign_keys.media_folder'))->nullable();
            $table
                ->foreign(Config::get('alphanews.foreign_keys.media_folder'))
                ->references('id')
                ->on((new $mediaFolderModel)->getTable());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('media_folders', static function (Blueprint $table) {
            $table->dropForeign('media_folders_'.Config::get('alphanews.foreign_keys.media_folder').'_foreign');
        });
        Schema::dropIfExists('media_folders');
    }
};
