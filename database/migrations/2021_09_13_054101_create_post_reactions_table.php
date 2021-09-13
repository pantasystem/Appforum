<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_reactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stamp_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('stamp_id')->references('id')->on('stamps');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->unique(['user_id', 'stamp_id', 'post_id']);
            $table->collation = 'utf8mb4_bin';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_reactions');
    }
}
