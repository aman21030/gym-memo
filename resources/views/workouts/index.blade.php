{{-- resources/views/workouts/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 space-y-8">

    {{-- ナビゲーション --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">トレーニング記録</h1>
    </div>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- トレーニング記録フォーム --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">💪筋トレ記録入力🦵</h2>
        <form method="POST" action="{{ route('workouts.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">日付</label>
                <input type="date" name="workout_date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">種目</label>
                <input type="text" name="exercise" list="exercises" class="w-full border rounded px-3 py-2" required>
                <datalist id="exercises">
                    @foreach ($distinctExercises as $exercise)
                        <option value="{{ $exercise }}">
                    @endforeach
                </datalist>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium text-sm">重量 (kg)</label>
                    <input type="number" step="0.1" name="weight" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium text-sm">回数</label>
                    <input type="number" name="reps" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium text-sm">セット数</label>
                    <input type="number" name="sets" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>


            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">記録する</button>
            </div>
        </form>
    </div>

    {{-- 有酸素記録フォーム --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">🏃‍♀️有酸素記録入力🏃‍♂️</h2>
        <form method="POST" action="{{ route('cardios.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">日付</label>
                <input type="date" name="cardio_date" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium">メニュー</label>
                <input type="text" name="menu" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium text-sm">消費カロリー (kcal)</label>
                    <input type="number" name="kcal" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium text-sm">距離 (km)</label>
                    <input type="number" step="0.01" name="distance_km" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium text-sm">時間 (分)</label>
                    <input type="number" name="duration_min" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">記録する</button>
            </div>
        </form>
    </div>

    {{-- 筋トレ記録一覧 --}}
    <div class="bg-gray-50 p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">今日の筋トレ記録</h2>
        <ul class="space-y-2">
            @foreach ($workouts as $workout)
                <li class="border-b pb-2 workout-item" data-exercise="{{ $workout->exercise }}" data-weight="{{ $workout->weight }}" data-reps="{{ $workout->reps }}" data-sets="{{ $workout->sets }}">
                    <div>{{ $workout->workout_date }} - {{ $workout->exercise }}</div>
                    <div>{{ $workout->weight }}kg × {{ $workout->reps }}回 × {{ $workout->sets }}セット</div>
                    <div class="text-sm text-right space-x-2 mt-1">
                        <a href="{{ route('workouts.edit', $workout->id) }}" class="text-blue-500">編集</a>
                        <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('削除してもよいですか？')" class="text-red-500">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 有酸素記録一覧 --}}
    <div class="bg-gray-50 p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">今日の有酸素記録</h2>
        <ul class="space-y-2">
            @foreach ($cardios as $cardio)
                <li class="border-b pb-2 cardio-item" data-menu="{{ $cardio->menu }}" data-kcal="{{ $cardio->kcal }}" data-distance="{{ $cardio->distance_km }}" data-duration="{{ $cardio->duration_min }}">
                    <div>{{ $cardio->cardio_date }} - {{ $cardio->menu }}</div>
                    <div>
                        {{ $cardio->kcal }}kcal /
                        {{ $cardio->distance_km }}km /
                        {{ $cardio->duration_min }}分
                    </div>
                    <div class="text-sm text-right space-x-2 mt-1">
                        <a href="{{ route('cardios.edit', $cardio->id) }}" class="text-blue-500">編集</a>
                        <form action="{{ route('cardios.destroy', $cardio->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('削除してもよいですか？')" class="text-red-500">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- SNS用コピー機能 --}}
    <div class="text-right mb-4">
        <button onclick="copyWorkoutToClipboard()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            📋 SNS用にコピー
        </button>
    </div>

    <script>
    function copyWorkoutToClipboard() {
        let text = "【本日のトレーニング】\n";

        // 筋トレ記録を取得
        document.querySelectorAll(".workout-item").forEach(item => {
            text += `${item.dataset.exercise}: ${item.dataset.weight}kg × ${item.dataset.reps}回 × ${item.dataset.sets}セット\n`;
        });

        // 有酸素記録を取得
        document.querySelectorAll(".cardio-item").forEach(item => {
            text += `${item.dataset.menu}: ${item.dataset.kcal}kcal / ${item.dataset.distance}km / ${item.dataset.duration}分\n`;
        });

        navigator.clipboard.writeText(text.trim())
            .then(() => alert("トレーニング記録をコピーしました！"))
            .catch(() => alert("コピーに失敗しました"));
    }
    </script>

    <div class="text-right">
        <a href="{{ route('workouts.history') }}" class="text-blue-600 hover:underline">▶ 過去の記録一覧を見る</a>
    </div>
</div>
@endsection
