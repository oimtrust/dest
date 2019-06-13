<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('testcase_id');
            $table->string('type');
            $table->string('severity');
            $table->string('priority');
            $table->integer('assigned_to');
            $table->string('title');
            $table->longText('description');
            $table->string('status');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('testcase_id')->references('id')->on('testcases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('issues', function (Blueprint $table) {
        //     $table->dropForeign('testcase_id');
        // });
        Schema::dropIfExists('issues');
    }
}
