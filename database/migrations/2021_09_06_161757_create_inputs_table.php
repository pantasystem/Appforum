<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // 入力の名称
            $table->string('name');
            $table->string('description')->nullable();

            // 必須であるか
            $table->boolean('is_required');
            $table->unsignedBigInteger('topic_template_id');

            $table->boolean('public')->default(true);
            // 入力タイプを表す
            $table->string('type');
            $table->foreign('topic_template_id')->references('id')->on('topic_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inputs');
    }
}
