<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cardio;
use Illuminate\Support\Facades\Auth;

class CardioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cardio_date' => 'required|date',
            'menu' => 'required|string|max:255',
            'kcal' => 'nullable|integer',
            'distance_km' => 'nullable|numeric',
            'duration_min' => 'nullable|integer',
        ]);

        Cardio::create([
            'cardio_date' => $request->cardio_date,
            'menu' => $request->menu,
            'kcal' => $request->kcal,
            'distance_km' => $request->distance_km,
            'duration_min' => $request->duration_min,
            'user_id' => Auth::id(), // ← ログインユーザーの ID をセット
        ]);

        return redirect('/workouts'); // 同じ画面に戻る
    }
    public function edit($id)
    {
        $cardio = Cardio::where('user_id', Auth::id())->findOrFail($id);
        return view('cardios.edit', compact('cardio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cardio_date' => 'required|date',
            'menu' => 'required|string|max:255',
            'kcal' => 'nullable|integer',
            'distance_km' => 'nullable|numeric',
            'duration_min' => 'nullable|integer',
        ]);

        $cardio = Cardio::where('user_id', Auth::id())->findOrFail($id);
        $cardio->update($request->all());

        return redirect('/workouts');
    }

    public function destroy($id)
    {
        $cardio = Cardio::where('user_id', Auth::id())->findOrFail($id);
        $cardio->delete();

        return redirect('/workouts');
    }

}
