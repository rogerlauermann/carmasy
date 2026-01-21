<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app', ['livewire' => '⚡welcome-dashboard']);
});

Route::get('/dashboard', function () {
    return view('layouts.app', ['livewire' => '⚡welcome-dashboard']);
});
