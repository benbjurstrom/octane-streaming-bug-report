<?php

use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    $stream = OpenAI::chat()->createStreamed([
        "model" => "gpt-3.5-turbo",
        'messages' => [
            ['role' => 'user', 'content' => 'PHP is '],
        ],
    ]);
    return response()->stream(function () use ($stream) {
        foreach ($stream as $response) {
            echo $response->choices[0]->delta->content;
            flush();
        }
    },
        200,
        ['X-Accel-Buffering' => 'no']);
});
