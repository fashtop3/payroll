<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('emp_dates')) {

            Schema::create('emp_dates', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('profile_id')->unsigned(); //foreign key
                $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade');
                $table->date('dob')->nullable(); //date of birth
                $table->date('doe')->nullable(); //date of employment
                $table->date('doc')->nullable(); //date of confirmation
                $table->date('last_promotion')->nullable(); //last_promotion
                $table->date('pension_scheme')->nullable(); //pension scheme
                $table->date('last_salary')->nullable(); //last salary
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emp_dates');
    }
}
