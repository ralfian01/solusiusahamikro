<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('no_telepon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor', 15);
            $table->boolean('notifikasi')->default(false);
            $table->morphs('owner');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('no_telepon');
    }
};
