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
        Schema::create('invoice_details', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_Invoice');
        $table->string('invoice_number');
        $table->string('product');
        $table->unsignedBigInteger('Section');
        $table->string('Status');
        $table->integer('Value_Status');
        $table->text('note')->nullable();
        $table->date('Payment_Date')->nullable();
        $table->string('user');
        $table->timestamps();

        $table->foreign('id_Invoice')->references('id')->on('invoices')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
