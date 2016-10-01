<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('profiles')) {

            Schema::create('profiles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('created_by')->unsigned()->nullable(); //foreign key
                $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
                $table->string('eid', 20)->nullable();
                $table->string('title', 10);
                $table->string('lastname', 50);
                $table->string('firstname', 50);
                $table->string('middlename', 50);
                $table->boolean('active')->default(0);
                $table->string('address1', 255);
                $table->string('address2', 255)->nullable();
                $table->integer('state_id')->unsigned()->nullable(); //foreign key
                $table->foreign('state_id')
                    ->references('id')
                    ->on('states')
                    ->onDelete('set null');
                $table->string('city', 20);
                $table->string('postal', 50)->nullable();
                $table->string('country', 50);
                $table->string('mobile_phone', 20);
                $table->string('home_phone', 20)->nullable();
                $table->string('office_phone', 20)->nullable();
                $table->string('email', 50)->unique();
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null');
                $table->integer('department_id')->unsigned()->nullable();
                $table->foreign('department_id')
                    ->references('id')
                    ->on('departments')
                    ->onDelete('set null');
                $table->string('department', 255)->nullable();
                $table->string('designation', 255)->nullable();
                $table->boolean('approved')->default(0);
                $table->softDeletes();
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
        Schema::drop('profiles');
    }
}
