<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            # Campos de la table
            $table->string('code',200)->default('valor_por_defecto');
            $table->string('title',200);
            $table->string('description',1600);
            $table->string('organizator');
            $table->dateTime('available_at');
            $table->dateTime('finish_at');
            $table->unsignedBigInteger('capacity')->default(200);
            $table->unsignedBigInteger('ubication_id');
            $table->timestamps();
        });
        //->addMedia(storage_path('demo/Image.png'))
        //->toMediaCollection();
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
