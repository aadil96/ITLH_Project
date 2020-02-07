<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('client_id');
            $table->string('title');
            $table->text('description');
            $table->longText('specification_document_url');
            $table->string('turn_around_time');
            $table->string('company_name')->nullable();
            $table->bigInteger('cost_low');
            $table->bigInteger('cost_high');
            $table->text('tags');
            $table->string('status');
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
        Schema::dropIfExists('assignments');
    }
}
