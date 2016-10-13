<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicUserAmtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_user_amts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned(); //foreign key
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade');
            $table->integer('basic_id')->unsigned();
            $table->foreign('basic_id')
                ->references('id')
                ->on('basics')
                ->onDelete('cascade');
            $table->decimal('amount', 20, 2)->default(0.00);;
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
        Schema::dropIfExists('basic_user_amts');
    }
}
