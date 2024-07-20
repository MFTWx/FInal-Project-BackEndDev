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
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->id(); // id of invoice
            $table->unsignedBigInteger('invoice_header_id'); // foreign key
            $table->unsignedBigInteger('toy_id'); // foreign key
            $table->integer('quantity'); // quantity of toy
            $table->unsignedBigInteger('subTotal'); // subtotal of toy
            $table->timestamps(); // timestamp of invoice

            $table->foreign('invoice_header_id')->references('id')->on('invoice_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('toy_id')->references('id')->on('toys')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_detail');
    }
};
