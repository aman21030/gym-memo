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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('workout_date');     // トレーニング日
            $table->string('exercise');       // 種目名（例：スクワット）
            $table->decimal('weight', 5, 2);  // 重量（kg）
            $table->integer('reps');          // 回数
            $table->integer('sets');          // ← セット数
            $table->timestamps();             // 作成/更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
