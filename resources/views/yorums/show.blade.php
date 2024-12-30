<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film->title }} - Yorumlar</title>
    <link href="{{ asset('CSS/examp.css') }}" rel="stylesheet">
</head>
<style>
    .bstl{margin-top: 15px;margin-right: 15px;
    font-size: 13px;}
</style>
<body>
    <header>
        {{-- <img src="{{ asset('storage/' . $film->cover_image) }}" alt="{{ $film->title }} Kapak Resmi" class="cover-image">
        <h2>{{ $film->title }}</h2>
        <title>{{ $film->title }} - Yorumlar @if($averageRating) (Ortalama Puan: {{ number_format($averageRating, 1) }}) @endif</title>

        <h4>"{{$film->description}}"</h4> --}}
        
        <a class="menu-item" href="{{ route('layout') }}"><button class="menu-container">Filmlere geri dön ⬅</button></a>
        <h4>{{ $film->title }}  @if($averageRating) (⭐{{ number_format($averageRating, 1) }} / 5) @endif</h4>
    </header>

    <main>
        <!--<h2>Yorumlar</h2>-->
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="container">
            <!-- Sol Taraf: Film Bilgileri -->
            <div class="containerleft">
                <img src="{{ asset('storage/' . $film->cover_image) }}" alt="{{ $film->title }} Kapak Resmi">
                {{--     --}}
                <h5><b>Tür:</b> ({{$film->genre}})  &nbsp;<b>Yazar:</b> ({{$film->author}})</h5>
                <p>"&nbsp;{{ $film->description }}"</p>
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
                    <form action="{{ route('yorums.store', $film->id) }}" method="POST">
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