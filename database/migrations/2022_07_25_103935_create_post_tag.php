<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('post_post_tag', static function (Blueprint $table) {
            $table->foreignId('post_tag_id')->constrained();
            $table->foreignId('post_id')->constrained();
            $table->unique(['post_id', 'post_tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_post_tag');
    }
};
