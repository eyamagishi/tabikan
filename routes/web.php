<?php

use Illuminate\Support\Facades\Route;
use App\Models\Hotel;

Route::get('/hotels', function () {
    return Hotel::with('rooms')->get();
});
