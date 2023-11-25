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
        Schema::create('medcines', function (Blueprint $table) {
            $table->id();
            $table->string('enSciName');
            $table->string('arSciName');
            $table->string('enUseName')->unique();
            $table->string('arUseName');
           // $table->string('enCatigory');
           // $table->string('arCatigory');
           $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('companyName');
            $table->integer("qtn");
            $table->date("expiredDate");
            $table->integer("price");
            $table->boolean("show")->default(false);
            $table->text("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medcines');
    }
};