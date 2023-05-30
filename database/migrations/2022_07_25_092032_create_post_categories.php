<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('post_categories', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color', 15);
            $table->foreignId('post_category_id')->nullable()->constrained();
            $table->unsignedInteger('posts_amount')->default(0);
            $table->unique(['name']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
