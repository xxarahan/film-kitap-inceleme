<title>Anasayfa</title>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="{{ asset('CSS/examp.css') }}" rel="stylesheet"> <!-- CSS dosyanızı buraya ekleyin -->
    <div class="menu-container" >
        <a href="/login" class="menu-item"><button class="menu-container">🔓 Giriş yap</button></a>
        
            <a href="/registration" class="menu-item"><button class="menu-container">📝 Kayıt ol</button></a>
        
        
    </div>
    
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        <div class="text-center mb-4">
            <h1 class="text-warning" style="font-family: 'Courier New', Courier, monospace;"><!--🎬-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filmler&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--🎬--></h1>
        </div>
    
    
    
    <!--<div class="">-->
        <!--<h1 class="text-center">Filmler</h1>-->
        

        <div class="slider-container">
            <div class="slider" id="filmSlider">
                @foreach($filmler as $film)
                    @if($film->cover_image)
                        <img src="{{ asset('storage/' . $film->cover_image) }}" alt="{{ $film->title }} Kapak Resmi">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Kapak+Resmi+Yok" alt="Kapak Resmi Yok">
                    @endif
                @endforeach
            </div>
        </div>
    <!--</div>-->
    
    <div class="text-center mb-4 mt-5">
        <h1 class="text-warning" style="font-family: 'Courier New', Courier, monospace; font-size: 2.5rem;"><!--📖-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kitaplar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--📖--></h1>
    </div>
    
    <div class="slider-container">
        <div class="slider" id="kitapSlider">
            @foreach($kitaplar as $kitap)
                @if($kitap->cover_image)
                    <img src="{{ asset('storage/' . $kitap->cover_image) }}" alt="{{ $kitap->title }} Kapak Resmi">
                @else
                    <img src="https://via.placeholder.com/300x200?text=Kapak+Resmi+Yok" alt="Kapak Resmi Yok">
                @endif
            @endforeach
        </div>

    
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    // Film Slider
    const filmSlider = $('#filmSlider');
    const totalFilmImages = filmSlider.children('img').length;
    let currentFilmIndex = 0;

    function moveToNextFilm() {
        const currentFilm = filmSlider.children('img').eq(currentFilmIndex);
    
    // Mevcut filmi listenin sonuna ekle
    //filmSlider.append(currentFilm.clone()); // Mevcut filmi kopyala ve sona ekle
    
    // Film indeksini artır
    currentFilmIndex++;
    
    // Eğer indeks toplam resim sayısını aşarsa, sıfırlanır
    if (currentFilmIndex >= totalFilmImages) {
        currentFilmIndex = 0; // Son elemana ulaştığında ilk elemana dön
    }
    
    // Kaydırıcıyı güncelle
    updateFilmSlider();
    }

    function updateFilmSlider() {
        const offset = -currentFilmIndex * (300 + 20); // 300px genişlik + 20px margin
        filmSlider.css('transform', 'translateX(' + offset + 'px)');
    }

    // Otomatik kaydırma
    setInterval(moveToNextFilm, 3000); // Her 3 saniyede bir kaydır

    // Kitap Slider
    const kitapSlider = $('#kitapSlider');
    const totalKitapImages = kitapSlider.children('img').length;
    let currentKitapIndex = 0;

    function moveToNextKitap() {
        currentKitapIndex++;
        if (currentKitapIndex >= totalKitapImages) {
            currentKitapIndex = 0; // Son elemana ulaştığında ilk elemana dön
        }
        updateKitapSlider();
    }

    function updateKitapSlider() {
        const offset = -currentKitapIndex * (300 + 20); // 300px genişlik + 20px margin
        kitapSlider.css('transform', 'translateX(' + offset + 'px)');
    }

    // Otomatik kaydırma
    setInterval(moveToNextKitap, 2000); // Her 3 saniyede bir kaydır
});

    </script>
{{-- <footer>
    <p>&copy; 2023 Film ve Kitap Yorumları</p>
</footer>  --}}
<footer>
    &copy; 2023 Film ve Kitap Yorumları
</footer>
</div> 
</body>

</html>




