<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShareExperienceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home_dashboard');
});

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/share-experience', function () {
    return view('share_experience');
});

Route::post('/share-experience', [ShareExperienceController::class, 'store'])->name('store');


Route::get('/profile', function () {
    $experiences = DB::table('vacation_experience')
                    ->where('user_id', Auth::id())
                    ->get();

    // Mengirim data ke view profile
    return view('profile', compact('experiences'));
})->middleware('auth');

// Route untuk menampilkan form edit (GET)
Route::get('/experience/edit/{id}', [ShareExperienceController::class, 'edit'])->middleware('auth');

// Route untuk memproses update (PUT karena kita pake @method('PUT') di blade)
Route::put('/experience/update/{id}', [ShareExperienceController::class, 'update'])->middleware('auth');

// Tambahkan baris ini di web.php
Route::delete('/experience/delete/{id}', [ShareExperienceController::class, 'destroy'])
    ->middleware('auth')
    ->name('experience.destroy');
