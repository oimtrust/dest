<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('epic');
            $table->longText('user_story');
            $table->longText('acceptance_criteria')->nullable();
            $table->longText('data')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->integer('created_by');
            $table->integer('deleted_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('stories', function (Blueprint $table)
        // {
        //     $table->dropForeign(['project_id']);
        // });
        Schema::dropIfExists('stories');
    }
}
