<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 use App\Jobs\SendWelcomeEmail;

Route::get('/', function () {
    return view('welcome');
});
 
 
use App\Jobs\SendRealEmail;

Route::get('/send-static-email', function () {
    SendRealEmail::dispatch(); 
    return 'Static email job dispatched!';
});

Route::get('/send-dynamic-email', function () {
    SendRealEmail::dispatch('friend@example.com', 'Dynamic User');
    return 'Dynamic email job dispatched!';
});