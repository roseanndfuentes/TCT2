<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search-user', function (Request $request) {

    $search = $request->query('search');

    if (! $search) {
        return response()->json([]);
    }

    $users = User::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        })
        ->get()
        ->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];
        });

    return response()->json($users);
});

Route::get('/holidays', function () {
    $holidays = \App\Models\Holiday::all()->map(function ($holiday) {
        return [
            'id' => $holiday->id,
            'title' => $holiday->name,
            'start' => $holiday->date_start,
            'end' => $holiday->date_end,
        ];
    });

    return response()->json($holidays);
});
