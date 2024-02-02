<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('sku')->nullable();
            $table->string('type');
            $table->string('name');
            $table->string('slug');
            $table->string('foto')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->string('category_id')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('products');
            $table->timestamps();

            // $table->fullText('name');
            // $table->fullText('slug');
            // $table->fullText('short_description');
            // $table->fullText('description');
        });
        DB::statement('ALTER TABLE products ADD FULLTEXT search(name,slug,short_description,description)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
