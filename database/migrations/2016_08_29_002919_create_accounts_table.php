<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('accounts')) {

            Schema::create('accounts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('profile_id')->unsigned(); //foreign key
                $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade');
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null');
                $table->string('work_rotation', 255)->nullable();
                $table->integer('bank_id')->unsigned()->nullable(); //foreign
                $table->foreign('bank_id')
                    ->references('id')
                    ->on('banks')
                    ->onDelete('set null');
                $table->string('bank_address', 255)->nullable();
                $table->string('account_type', 255);
                $table->string('account_name', 255);
                $table->string('account_number', 20);
                $table->string('bank_reference', 255)->nullable();
                $table->string('routine_number', 255)->nullable();
                $table->boolean('hold_pay')->default(0);
                $table->string('currency', 10)->nullable();
                $table->boolean('taxable')->default(0);
                $table->string('pfa', 255)->nullable();
                $table->string('pfa_number', 255)->nullable();
                $table->decimal('base_amount', 20, 2)->default(0.00);
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
        Schema::drop('accounts');
    }
}
