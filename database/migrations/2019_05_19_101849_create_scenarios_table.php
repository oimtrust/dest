<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->longText('prerequisites')->nullable();
            $table->longText('test_step');
            $table->unsignedBigInteger('feature_id');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('scenarios', function (Blueprint $table) {
        //     $table->dropForeign('feature_id');
        // });
        Schema::dropIfExists('scenarios');
    }
}
