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
        Schema::create('distribute_fund_amounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fund_distribution_id');
            $table->string('fund_title');
            $table->unsignedBigInteger('order_id');
            $table->string('order_number');
            $table->unsignedBigInteger('vendor_id');
            $table->string('vendor_name');
            $table->float('amount');
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
        Schema::dropIfExists('distribute_fund_amounts');
    }
};