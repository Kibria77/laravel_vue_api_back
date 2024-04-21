<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->integer('brand_id');
            $table->integer('unit_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('model')->nullable();
            $table->float('regular_price', 10, 2)->default(0);
            $table->float('selling_price', 10, 2)->default(0);
            $table->string('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('image')->nullable();
            $table->integer('hit_count')->default(0);
            $table->integer('sales_count')->default(0);
            $table->tinyInteger('feature_status')->default(0);
            $table->tinyInteger('special_status')->default(0);
            $table->integer('sku')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
