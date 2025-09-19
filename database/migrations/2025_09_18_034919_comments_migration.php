<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('content');
            $table->enum('status', ['pending', 'approved', 'spam'])->default('pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->uuid('post_id');
            $table->uuid('author_id');
            $table->uuid('parent_id')->nullable();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->index(['status', 'post_id', 'author_id', 'parent_id']);
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
