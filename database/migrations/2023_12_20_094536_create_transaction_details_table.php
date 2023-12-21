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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->decimal('price_at');
            $table->timestamps();
            $table->foreign('transaction_id')->references('id')
                ->on('transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('item_id')->references('id')
                ->on('items')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['item_id']);
        });
        Schema::dropIfExists('transaction_details');
    }
};
