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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID as primary key
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255); // Renamed password_hash to password for convention
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_url', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->rememberToken();
            $table->timestamps(); // Defines created_at and updated_at

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
            $table->index(['username', 'email']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
