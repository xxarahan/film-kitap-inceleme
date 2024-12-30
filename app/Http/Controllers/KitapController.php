<?php

namespace App\Http\Controllers;
use App\Models\Film;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Yorum;
use App\Models\Kitap;

class KitapController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'author' => 'string', // Resim doğrulama
            'genre' => 'required|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        $kitap = new Kitap();
        $kitap->title =$request->input('title');
        $kitap->description = $request->input('description');
        $kitap->author = $request->input('author');
        $kitap->genre = $request->input('genre');
        

        if ($request->hasFile('cover_image')) {
            $kitap->cover_image = $request->file('cover_image')->store('kitap_images', 'public');
        }
        $kitap->save();
        $kitap->kitap_id = $kitap->id;
        $kitap->save();
        session(['kitap' => $kitap]);
        

        

        return redirect()->route('kitaps.index')->with('success','başarıyla oluştu');
    }
    public function index(){
        $kitaplar = Kitap::all(); // Tüm filmleri al
        return view('kitaps.index', compact('kitaplar')); // films/index.blade.php dosyasını döner
    }
    public function create(){
            return view('kitaps.create');
    }
    public function destroy($id){
        $kitap = Kitap::find($id);
        if ($kitap->cover_image) {
            //Storage::delete($film->cover_image);
            Storage::disk('public')->delete($kitap->cover_image);
    
            Log::info('Dosya silindi: ' . $kitap->cover_image);
        }else{
            Log::warning('Silinmeye çalışılan dosya bulunamadı: ' . $kitap->cover_image);
            return redirect()->back()->with('error', 'Dosya bulunamadı.');
        }
        $kitap->delete();
        
        return redirect()->back()->with('success', 'kitap başarıyla silindi');
        
    
    }
    public function show($id){
        $kitap = kitap::findOrFail($id);
        $yorums = Yorum::where('kitap_id', $id)->with('user')->get();
        $averageRating = $yorums->avg('rating');
        return view('yorums.showKitap', compact('kitap', 'yorums', 'averageRating'));
    
    }
        
}
