<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kitap->title }} - Yorumlar</title>
    <link href="{{ asset('CSS/examp.css') }}" rel="stylesheet">
</head>
<style>
    .bstl{margin-top: 15px;margin-right: 15px;
    font-size: 13px;}
</style>
<body>
    <header>
        <a class="menu-item" href="{{ route('layout') }}"><button class="menu-container">Kitaplara geri dön ⬅</button></a>
        <h4>{{ $kitap->title }}  @if($averageRating) (⭐{{ number_format($averageRating, 1) }} / 5) @endif</h4>
    </header>

    <main>
        <!--<h2>Yorumlar</h2>-->
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="container">
            <!-- Sol Taraf: Film Bilgileri -->
            <div class="containerleft">
                <img src="{{ asset('storage/' . $kitap->cover_image) }}" alt="{{ $kitap->title }} Kapak Resmi">
                {{--     --}}
                <h5><b>Tür:</b> ({{$kitap->genre}})  &nbsp;<b>Yazar:</b> ({{$kitap->author}})</h5>
                <i>"&nbsp;{{ $kitap->description }}"</i>
            </div>
        
            <!-- Sağ Taraf: Yorum Ekleme ve Yorumlar -->
            <div class="right-container">
                
        
                <div class="comments-container">
                    <!-- Tüm yorumlar burada yer alacak -->
                    <h3>Tüm Yorumlar</h3>
                    @if($yorums->isEmpty())
                        <p>Henüz yorum yok.</p>
                    @else
                        <ul class="comment-list">
                            
                            @foreach($yorums as $yorum)
                            
                            <li>
                                <small>({{ $yorum->user->hasRole('admin') ? 'admin' : 'user' }})</small>
                                <strong>{{ $yorum->user->name }}:</strong> {{ $yorum->yorum }} <br>
                                <small>{{ $yorum->created_at->diffForHumans() }}</small> | 
                                <strong>Puan:</strong> {{ $yorum->rating }} <br>
                                 
                                @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->id() == $yorum->user_id))
                                    <form action="{{route('yorums.destroy', $yorum->id)}}" method="POST" onsubmit="return confirm('Yorum silinsin mi?');">
                                    @csrf
                                    @method('DELETE')<!--delete methodu-->
                                    <button type="submit" class="btn btn-danger">Yorumu sil</button> 
                                    </form>   
                                @endif
                                
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="comments-containermini">
                    <!-- Yorum ekleme formu burada yer alacak -->
                    <form action="{{ route('yorums.storeKitap', $kitap->id) }}" method="POST">
                        @csrf
                        <textarea name="yorum" rows="4" placeholder="Yorumunuzu buraya yazın..." required></textarea>
                        <select name="rating" id="rating" required>
                            <option value="" disabled selected>IMDB Rating⭐</option>
                            <option value="1">1⭐</option>
                            <option value="2">2⭐</option>
                            <option value="3">3⭐</option>
                            <option value="4">4⭐</option>
                            <option value="5">5⭐</option>
                        </select>
                        <button type="submit">Yorum Ekle</button>
                    </form>
                </div>
            </div>
            
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Film ve Kitap Yorumları</p>
    </footer>
</body>
</html>