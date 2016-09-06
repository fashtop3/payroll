<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('personals')) {

            Schema::create('personals', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('profile_id')->unsigned(); //foreign key
                $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade');
                $table->enum('gender', ['male', 'female']);
                $table->enum('status', ['married', 'single', 'divorced']);
                $table->string('nationality')->nullable();
                $table->integer('state_of_origin')->unsigned()->nullable();
                $table->foreign('state_of_origin')
                    ->references('id')
                    ->on('states')
                    ->onDelete('set null');
                $table->integer('paye_state')->unsigned()->nullable();
                $table->foreign('paye_state')
                    ->references('id')
                    ->on('states')
                    ->onDelete('set null');
                $table->string('language', 255)->nullable();
                $table->string('location', 255)->nullable();
                $table->string('cost_center', 255)->nullable();
                $table->string('notes', 255)->nullable();
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
        Schema::drop('personals');
    }
}
