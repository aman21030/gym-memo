@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 space-y-6 px-5">
    <h1 class="text-2xl font-bold mb-4">{{ $date }} の記録</h1>

    {{-- SNSコピー用ボタン --}}
    <div class="text-right mb-4">
        <button onclick="copyWorkoutToClipboard()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            📋 SNS用にコピー
        </button>
    </div>

    {{-- JSへ日付を渡すための hidden 要素追加 --}}
    <input type="hidden" id="copy-date" value="{{ \Carbon\Carbon::parse($date)->format('n/j') }}">


    {{-- 筋トレの記録 --}}
    @if ($workouts->isNotEmpty())
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">筋トレ記録</h2>
            <ul class="space-y-2">
                @foreach ($workouts as $workout)
                    <li class="bg-gray-50 p-3 rounded flex justify-between items-center workout-item"
                        data-exercise="{{ $workout->exercise }}"
                        data-weight="{{ $workout->weight }}"
                        data-reps="{{ $workout->reps }}"
                        data-sets="{{ $workout->sets }}">
                        <div>
                            {{ $workout->exercise }}: 
                            {{ $workout->weight }}kg × 
                            {{ $workout->reps }}回 × 
                            {{ $workout->sets }}セット
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('workouts.edit', $workout->id) }}" class="text-blue-500 hover:underline">編集</a>
                            <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" onsubmit="return confirm('削除してもよいですか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 有酸素の記録 --}}
    @if ($cardios->isNotEmpty())
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">有酸素記録</h2>
            <ul class="space-y-2">
                @foreach ($cardios as $cardio)
                    <li class="bg-gray-50 p-3 rounded flex justify-between items-center cardio-item"
                        data-menu="{{ $cardio->menu }}"
                        data-kcal="{{ $cardio->kcal }}"
                        data-distance="{{ $cardio->distance_km }}"
                        data-duration="{{ $cardio->duration_min }}">
                        <div>
                            {{ $cardio->menu }}: 
                            {{ $cardio->kcal }}kcal / 
                            {{ $cardio->distance_km }}km / 
                            {{ $cardio->duration_min }}分
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('cardios.edit', $cardio->id) }}" class="text-blue-500 hover:underline">編集</a>
                            <form action="{{ route('cardios.destroy', $cardio->id) }}" method="POST" onsubmit="return confirm('削除してもよいですか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 戻るボタン --}}
    <div class="mt-6">
        <a href="{{ route('workouts.history') }}" class="text-blue-500 hover:underline">← 一覧へ戻る</a>
    </div>
</div>

{{-- ✅ JS追加 --}}
<script>
function copyWorkoutToClipboard() {
    const date = document.getElementById('copy-date').value;
    let text = `【${date}のトレーニング】\n`;

    document.querySelectorAll(".workout-item").forEach(item => {
        text += `${item.dataset.exercise}: ${item.dataset.weight}kg × ${item.dataset.reps}回 × ${item.dataset.sets}セット\n`;
    });

    document.querySelectorAll(".cardio-item").forEach(item => {
        text += `${item.dataset.menu}: ${item.dataset.kcal}kcal / ${item.dataset.distance}km / ${item.dataset.duration}分\n`;
    });

    navigator.clipboard.writeText(text.trim())
        .then(() => alert("トレーニング記録をコピーしました！"))
        .catch(() => alert("コピーに失敗しました"));
}
</script>

@endsection
