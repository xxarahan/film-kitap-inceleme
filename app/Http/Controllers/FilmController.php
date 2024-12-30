<?php

namespace App\Http\Controllers;
use App\Models\Film;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Yorum;
use App\Models\Kitap;

class FilmController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'author' => 'string', // Resim doğrulama
            'genre' => 'required|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        $film = new Film();
        $film->title =$request->input('title');
        $film->description = $request->input('description');
        $film->author = $request->input('author');
        $film->genre = $request->input('genre');
        
        

        if ($request->hasFile('cover_image')) {
            $film->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }
        $film->save();
        //$film->film_id = $film->id;
        //$film->save();
        session(['film' => $film]);
        
        

        

        return redirect()->route('films.index')->with('success','başarıyla oluştu');

    }

    public function index(){
    $filmler = Film::all(); // Tüm filmleri al
    return view('films.index', compact('filmler')); // films/index.blade.php dosyasını döner
    }
    public function create(){
        return view('films.create');
    }


    public function search(Request $request){
        $query = $request->input('query');
        $films = Film::where('title', 'like', "%{$query}%")
        ->orWhere('genre', 'like', "%{$query}%")->get();
        

    }
    public function edit($id)
{
    $film = Film::findOrFail($id);
    return view('edit', compact('film'));
}

public function update(Request $request, $id)
{
    $film = Film::findOrFail($id);
    
    $film->title = $request->input('title');
    $film->description = $request->input('description');
    
    if ($request->hasFile('cover_image')) {
        // Yeni kapak resmini yükle
        $path = $request->file('cover_image')->store('cover_images', 'public');
        $film->cover_image = $path;
    }
    
    $film->save(); // Değişiklikleri kaydet
    
    return redirect()->route('films.index')->with('success', 'Film başarıyla güncellendi.');
}
/*public function destroy($id)
{
    $film = Film::find($id);
    if ($film) {
        $film->delete();
        return redirect()->back()->with('success', 'Film başarıyla silindi.');
    }
    return redirect()->back()->with('error', 'Film bulunamadı.');
}*/
public function destroy($id){
    $film = Film::find($id);
    if ($film->cover_image) {
        //Storage::delete($film->cover_image);
        Storage::disk('public')->delete($film->cover_image);

        Log::info('Dosya silindi: ' . $film->cover_image);
    }else{
        Log::warning('Silinmeye çalışılan dosya bulunamadı: ' . $film->cover_image);
        return redirect()->back()->with('error', 'Dosya bulunamadı.');
    }
    $film->delete();
    /*if($film){
        $film->delete();
        return redirect()->back()->with('success', 'Film başarıyla silindi');
    }
    return redirect()->back()->with('error', 'Film bulunamadı');*/
    return redirect()->back()->with('success', 'Film başarıyl');
    

}
    public function show($id){
        $film = Film::findOrFail($id);
        $yorums = Yorum::where('film_id', $id)->with('user')->get();
        $averageRating = $yorums->avg('rating');
        return view('yorums.show', compact('film', 'yorums','averageRating'));
    
    }
}
