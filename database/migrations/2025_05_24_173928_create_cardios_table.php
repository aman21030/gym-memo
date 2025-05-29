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
        Schema::create('cardios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('cardio_date');              // 日付
            $table->string('menu');                   // 種目名（例：ランニング）
            $table->integer('kcal')->nullable();      // 消費カロリー
            $table->decimal('distance_km', 5, 2)->nullable(); // 距離（km）
            $table->integer('duration_min')->nullable();      // 時間（分）
            $table->timestamps();                     // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardios');
    }
};
