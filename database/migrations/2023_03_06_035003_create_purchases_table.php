<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
             $table->string('invoice_id');
             $table->date('due_date');
             $table->integer('tax');
             $table->integer('vat');
             $table->integer('load_unload');
             $table->integer('discount');
             $table->string('note');
             $table->string('card_phone_number');
             $table->string('payment_by');
             $table->string('method');
             $table->integer('amount');
             $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('purchases');
    }
};