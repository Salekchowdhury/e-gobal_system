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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('bank_list_id')->nullable()->constrained('bank_lists')->onDelete('cascade');
            $table->integer('amount');
            $table->integer('commission');
            $table->integer('final_amount');
            $table->integer('mobile_number');
            $table->string('account_name');
            $table->integer('account_number');
            $table->string('payment_type');
            $table->string('branch_name');
            $table->string('city')->nullable();
            $table->integer('routin_number')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=pending, 1=accepted');
            $table->date('withdraw_date');
            $table->date('approved_date');
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
        Schema::dropIfExists('withdraws');
    }
};
