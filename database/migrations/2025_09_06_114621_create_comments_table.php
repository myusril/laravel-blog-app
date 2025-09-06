<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')->constrained(
                table: 'posts',
                indexName: 'comments_post_id'
            );

            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'comments_user_id'
            );

            $table->foreignId('parent_id')->nullable()->constrained(
                table: 'comments',
                indexName: 'comments_parent_id'
            );

            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
