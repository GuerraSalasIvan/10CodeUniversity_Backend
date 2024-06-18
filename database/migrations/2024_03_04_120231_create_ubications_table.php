<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubications', function (Blueprint $table) {
            $table->id();
            $table->string('place',200);
            $table->string('code',200);
            $table->string('place_description',600);
            $table->string('address',200);
            $table->integer('capacity');
            $table->time('opens_at');
            $table->time('closes_at');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ubications');
    }
};
