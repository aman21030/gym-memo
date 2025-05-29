@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow space-y-6">

    <h1 class="text-2xl font-bold mb-4">トレーニング編集</h1>

    <form method="POST" action="{{ route('workouts.update', $workout->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">日付</label>
            <input type="date" name="workout_date" value="{{ $workout->workout_date }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">種目</label>
            <input type="text" name="exercise" value="{{ $workout->exercise }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block font-medium">重量 (kg)</label>
                <input type="number" name="weight" step="0.1" value="{{ $workout->weight }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium">回数</label>
                <input type="number" name="reps" value="{{ $workout->reps }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium">セット数</label>
                <input type="number" name="sets" value="{{ $workout->sets }}" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('workouts.index') }}" class="text-blue-500 hover:underline">← 戻る</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">更新する</button>
        </div>
    </form>
</div>
@endsection
