<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('dob');
            $table->bigInteger('phone');
            $table->string('state');
            $table->string('country');
            $table->bigInteger('ref_code')->unique();
            $table->string('acct_name');
            $table->string('bank_name');
            $table->bigInteger('acct_num');
            $table->bigInteger('ref_by')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
