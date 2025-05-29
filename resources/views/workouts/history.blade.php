@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 space-y-6">
    <h1 class="text-2xl font-bold mb-6">過去のトレーニング記録一覧</h1>

    @foreach ($dates as $date)
        <div class="bg-white rounded shadow p-5 space-y-4">
            <h2 class="text-xl font-semibold text-blue-600 border-b pb-2">
                <a href="{{ route('workouts.history.date', ['date' => $date]) }}">{{ $date }}</a>
            </h2>

            @if (isset($groupedWorkouts[$date]) && count($groupedWorkouts[$date]) > 0)
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-gray-700 font-semibold mb-2">筋トレ：</p>
                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                        @foreach ($groupedWorkouts[$date] as $workout)
                            <li>{{ $workout->exercise }}: {{ $workout->weight }}kg × {{ $workout->reps }}回 × {{ $workout->sets }}セット</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (isset($groupedCardios[$date]) && count($groupedCardios[$date]) > 0)
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-gray-700 font-semibold mb-2">有酸素：</p>
                    <ul class="list-disc list-inside text-gray-800 space-y-1">
                        @foreach ($groupedCardios[$date] as $cardio)
                            <li>{{ $cardio->menu }}: {{ $cardio->kcal }}kcal / {{ $cardio->distance_km }}km / {{ $cardio->duration_min }}分</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endforeach

    <div class="text-right mt-6">
        <a href="{{ route('workouts.index') }}" class="text-blue-600 hover:underline">← トップへ戻る</a>
    </div>
</div>
@endsection
