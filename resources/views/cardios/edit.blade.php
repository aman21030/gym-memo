@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow space-y-6">
    <h1 class="text-2xl font-bold text-center">有酸素運動の編集</h1>

    <form method="POST" action="{{ route('cardios.update', $cardio->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">日付</label>
            <input type="date" name="cardio_date" value="{{ $cardio->cardio_date }}" required
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">メニュー</label>
            <input type="text" name="menu" value="{{ $cardio->menu }}" required
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">消費カロリー (kcal)</label>
            <input type="number" name="kcal" value="{{ $cardio->kcal }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">距離 (km)</label>
            <input type="number" step="0.01" name="distance_km" value="{{ $cardio->distance_km }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">時間 (分)</label>
            <input type="number" name="duration_min" value="{{ $cardio->duration_min }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-between">
            <a href="{{ url('/workouts') }}" class="text-blue-500 hover:underline">← トップへ戻る</a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">更新する</button>
        </div>
    </form>
</div>
@endsection
