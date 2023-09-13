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
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger('following_user_id');
            $table->unsignedBigInteger('followed_user_id');

            $table->index('following_user_id', 'follows_following_user_idx');
            $table->index('followed_user_id', 'follows_followed_user_idx');

            $table->foreign('following_user_id','follows_following_user_fk')->on('users')->references('id');
            $table->foreign('followed_user_id','follows_followed_user_fk')->on('users')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
