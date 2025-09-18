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
        Schema::create('media', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('file_name', 255);
            $table->string('file_url', 500);
            $table->enum('file_type', ['image', 'video', 'document']);
            $table->bigInteger('file_size');
            $table->text('alt_text')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
