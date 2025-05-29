<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Cardio;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{

    public function index()
    {
        $today = now()->toDateString(); // Carbonの代わりに now() を使えばOK
    
        // 🔽 ログインユーザーの記録だけ取得
        $workouts = Workout::where('user_id', Auth::id())
            ->whereDate('workout_date', $today)
            ->get();
    
        $cardios = Cardio::where('user_id', Auth::id())
            ->whereDate('cardio_date', $today)
            ->get();
    
        $distinctExercises = Workout::where('user_id', Auth::id())
            ->select('exercise')->distinct()->pluck('exercise');
    
        return view('workouts.index', compact('workouts', 'cardios', 'distinctExercises'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'workout_date' => 'required|date',
            'exercise' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'reps' => 'required|integer',
            'sets' => 'required|integer',
        ]);

        Workout::create([
            'workout_date' => $request->workout_date,
            'exercise' => $request->exercise,
            'weight' => $request->weight,
            'reps' => $request->reps,
            'sets' => $request->sets,
            'user_id' => Auth::id(),
        ]);

        return redirect('/workouts');
    }

    public function edit($id)
    {
        $workout = Workout::findOrFail($id);
        return view('workouts.edit', compact('workout'));
    }

    // 👇 更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'workout_date' => 'required|date',
            'exercise' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'reps' => 'required|integer',
            'sets' => 'required|integer',
        ]);

        $workout = Workout::findOrFail($id);
        $workout->update($request->all());

        return redirect('/workouts');
    }

    // 👇 削除処理
    public function destroy($id)
    {
        $workout = Workout::findOrFail($id);
        $workout->delete();

        return redirect('/workouts');
    }

    public function history()
    {
        $userId = Auth::id();

        $dates = Workout::where('user_id', $userId)
            ->select('workout_date')
            ->distinct()
            ->orderBy('workout_date', 'desc')
            ->pluck('workout_date');

        // 全ワークアウトを日付ごとにグループ化
        $groupedWorkouts = Workout::where('user_id', $userId)
            ->get()
            ->groupBy('workout_date');

        // 全カーディオを日付ごとにグループ化
        $groupedCardios = Cardio::where('user_id', $userId)
            ->get()
            ->groupBy('cardio_date');

        return view('workouts.history', compact('dates', 'groupedWorkouts', 'groupedCardios'));
    }

    public function showByDate($date)
    {
        $workouts = Workout::where('user_id', Auth::id())
            ->where('workout_date', $date)
            ->get();
    
        $cardios = Cardio::where('user_id', Auth::id())
            ->where('cardio_date', $date)
            ->get();
    
        return view('workouts.by_date', compact('date', 'workouts', 'cardios'));
    }
    
}
