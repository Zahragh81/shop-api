<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image');
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('quantity')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
