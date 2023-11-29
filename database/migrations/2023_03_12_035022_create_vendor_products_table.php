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
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('cat_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcat_id')->nullable()->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('innersubcat_id')->nullable()->constrained('innersubcategories')->onDelete('cascade');
            $table->string('product_name');
            $table->string('brand');
            $table->string('description');
            $table->string('tag');
            $table->float('product_price');
            $table->string('discounted_price');
            $table->integer('product_qty');
            $table->string('slug');
            $table->integer('is_variation');
            $table->string('attribute');
            $table->integer('status')->default('0');
            $table->integer('is_hot')->default('2')->comment('1=yes,2=no');
            $table->integer('free_shipping');
            $table->integer('flat_rate');
            $table->string('shipping_cost');
            $table->integer('is_return');
            $table->string('return_days');
            $table->integer('is_featured');
            $table->string('available_stock');
            $table->integer('est_shipping_days');
            $table->string('sku');
            $table->integer('point');
            $table->string('tax');
            $table->string('tax_type');
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
        Schema::dropIfExists('vendor_products');
    }
};