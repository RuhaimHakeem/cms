<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chequedetails', function (Blueprint $table) {
            $table->id();
            $table->date('depositdate');
            $table->string('payto');
            $table->decimal('amount', $precision = 19, $scale = 2);
            $table->string('currency');
            $table->string('accountholdername');
            $table->string('accountholdernumber'); 
            $table->string('chequenumber');   
            $table->string('bankname');  
            $table->string('branchname');
            $table->string('image')->nullable(); 
            $table->string('status')->nullable(); 
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
        Schema::dropIfExists('chequedetails');
    }
}