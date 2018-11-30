<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_history', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('url'); // downloaded url
          $table->string('filename'); // filename
          $table->string('link')->nullable(); // link to file
          $table->string('status'); // job status
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_history');
    }
}
