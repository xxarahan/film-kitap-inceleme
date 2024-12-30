<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\YorumController;
use App\Http\Controllers\KitapController;
use App\Http\Controllers\UploadManager;
use App\Models\Film;
use App\Models\Kitap;


Route::get('/', function () {
    $filmler = Film::all();
    $kitaplar = Kitap::all();
    return view('welcome',compact('filmler','kitaplar'));
});


/*Route::middleware(['role:user'])->group(function(){
    Route::post('/yorum/yap', [YorumController::class, 'store']);
    
});*/

Route::middleware(['auth'])->group(function () {
    Route::get('/layout', [AuthManager::class, 'layout'])->name('layout');
    Route::get('/welcome', [AuthManager::class,'welcome'])->name('welcome');
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
    //Route::post('/yorum/yap', [YorumController::class, 'store']);
    
});

//Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
//Route::post('logout', [AuthManager::class, 'destroy'])->name('logout');
Route::get('/admin',[AuthManager::class, 'admin'])->name('admin');
Route::get("/upload", [UploadManager::class, "upload"])->name("upload");
Route::post("/upload", [UploadManager::class, "uploadPost"])->name("upload.post");
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('update');
Route::delete('/film/sil/{id}', [FilmController::class, 'destroy'])->name('film.sil');

Route::resource('films', FilmController::class);
/*
films.index (GET) - Tüm filmleri listelemek için
films.create (GET) - Yeni film eklemek için formu göstermek için
films.store (POST) - Yeni film kaydetmek için
films.show (GET) - Belirli bir filmi görüntülemek için
films.edit (GET) - Belirli bir filmi düzenlemek için formu göstermek için
films.update (PUT/PATCH) - Belirli bir filmi güncellemek için
films.destroy (DELETE) - Belirli bir filmi silmek için
*/
Route::get('/films/{id}/yorums', [YorumController::class,'show'])->name('yorums.show');

Route::post('/films/{id}/yorums', [YorumController::class, 'store'])->name('yorums.store');
Route::post('yorums/{id}', [YorumController::class, 'store'])->name('yorums.store');
Route::delete('yorums/{id}', [YorumController::class, 'destroy'])->name('yorums.destroy');

Route::resource('kitaps', KitapController::class);
Route::get('/kitaps/{id}/yorums', [YorumController::class,'showKitap'])->name('yorums.showKitap');
Route::post('/kitaps/{id}/yorums', [YorumController::class, 'storeKitap'])->name('yorums.storeKitap');

//Route::post('yorums/{id}', [YorumController::class, 'store'])->name('yorums.storeKitap');


Route::delete('/kitap/sil/{id}', [KitapController::class, 'destroy'])->name('kitap.sil');
//Route::delete('/kitaps/{id}/yorums/{id}', [YorumController::class, 'destroy'])->name('yorums.destroy');


//<a href="{{ route('comments.show', $film->id) }}">Yorumları Görüntüle</a>
//bunu ileride kullanıcam



