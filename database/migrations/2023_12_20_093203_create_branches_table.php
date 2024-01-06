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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('owner_id');
            $table->string('name',255);
            $table->string('location');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['owner_id']);
        });
        Schema::dropIfExists('branches');
    }
};
