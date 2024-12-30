<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Film;
use App\Models\Yorum;
use App\Models\Kitap;


class YorumController extends Controller
{
    public function show($id){
        $film = Film::findOrFail($id);
        $yorums = Yorum::where('film_id', $id)->with('user')->get();
        $averageRating = $yorums->avg('rating');
        return view('yorums.show', compact('film','yorums','averageRating'));
        //$yeniYorum=Yorum::find($film_Id);
        //return view('yorums.show', compact('yorums'));

    }
    public function showKitap($id){
        $kitap = Kitap::findOrFail($id);
        $yorums = Yorum::where('kitap_id', $kitap->id)->with('user')->get();
        $averageRating = $yorums->avg('rating');
        return view('yorums.showKitap', compact('kitap','yorums','averageRating'));
    }
    public function store(Request $request, $id){
        $request->validate([
            'yorum' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'kitap_id' => 'nullable|exists:kitaplar,id',
            'film_id' => 'nullable|exists:filmler,id',
        ]);
        $film = Film::find($id);
        if(!$film){
            return redirect()->route('films.index')->with('error','bu film veritabanında mevcut değil');
        }
        if(auth()->check()){

        $yorum = new Yorum();
        $yorum->user_id = auth()->id();    
        $yorum->yorum = $request->yorum;
        $yorum->rating =$request->rating;
        $yorum->film_id = $film->id;
        $yorum->save();
        //dd($request->all());
        return redirect()->route('yorums.show', $id);

        }else{
            return response()->json(["error","user didnt sign-in"]);
        }
    }
    public function storeKitap(Request $request, $id){
        $request->validate([
            'yorum' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'kitap_id' => 'nullable|exists:kitaplar,id',
            'film_id' => 'nullable|exists:filmler,id',
        ]);
        $kitap = Kitap::find($id);
        if(!$kitap){
            return redirect()->route('kitaps.index')->with('error', 'Bu kitap bulunamadı.');

        }
        $yorum = new Yorum();
        $yorum->user_id= auth()->id();
        $yorum->yorum = $request->yorum;
        $yorum->rating = $request->rating;
        $yorum->kitap_id = $kitap->id;
        $yorum->save();

        //return redirect()->route('yorums.showKitap', ['id' => $kitap->id])
        //                 ->with('success', 'Kitap için yorum başarıyla eklendi.');
        return redirect()->route('yorums.showKitap', $id);
    }
    public function destroy($id){
        $yorum = Yorum::find($id);
    
        if ($yorum) {
            // Yorum varsa, sil
            if($yorum->kitap_id==null){
            $yorum->delete();
            $film_ID = $yorum->film_id;
            return redirect()->route('yorums.show', ['id' => $film_ID])
                     ->with('success', 'Yorum başarıyla silindi.');
            }
            else if($yorum->film_id==null){
                $yorum->delete();
                $kitap_ID = $yorum->kitap_id;
                return redirect()->route('yorums.showKitap', ['id' => $kitap_ID])
                     ->with('success', 'Yorum başarıyla silindi.');

            }
            // Başarı mesajı ile yönlendir
            //return redirect()->route('/films/{id}/yorums');
            //return redirect()->route('/films/{id}', $id);
            

        } else {
            // Yorum bulunamazsa hata mesajı
            //return redirect()->route('/films/{id}/yorums')->with('error', 'Yorum bulunamadı.');
            return redirect()->route('yorums.show', ['id' => $film_ID])
                     ->with('error', 'Yorum silinemedi.');
        }
    }
    
}
