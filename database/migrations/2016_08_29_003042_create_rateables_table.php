<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('rateables')) {

            Schema::create('rateables', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('profile_id')->unsigned(); //foreign key
                $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade');
                $table->integer('paytype_id')->unsigned()->nullable(); //foreign key
                $table->foreign('paytype_id')
                    ->references('id')
                    ->on('pay_types')
                    ->onDelete('set null');
                $table->integer('basic_id')->unsigned()->nullable();
                $table->foreign('basic_id')
                    ->references('id')
                    ->on('basics')
                    ->onDelete('set null');
                $table->boolean('taxable')->default(0);
                $table->decimal('total', 20,2)->default(0.00);
                $table->integer('approved_by')->unsigned()->nullable(); //foreign key
                $table->foreign('approved_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
                $table->string('umonth');
                $table->timestamps();

                $table->unique(['profile_id', 'paytype_id', 'umonth']);
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
        Schema::dropIfExists('rateables');
    }
}
