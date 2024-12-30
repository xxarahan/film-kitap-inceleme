<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film ve Kitap Yorumları</title>
    <link  href="CSS/examp.css" rel="stylesheet">
    
    
</head>

<style>
    .sec_{
        font-size: 19px;
        
    }
    .bsecp_{
        position:absolute;
        top: 10px;
        left: 10px;
        
    }
    .bsecp_ + .bsecp_ {  /* Sonraki butonlar için farklı konum */
    top: 30px; /* Birinci butondan biraz aşağı */
    }
    
    
    
    
    
</style>

<body>
    <div class="bsecp_">
        @if(auth()->user()->hasRole('admin'))
            <select class="menu-container" onchange="handleSelectChange(this)">
                <option value=""><!--╰➤--> Admin Girişi...</option>
                <option value="{{ route('films.index') }}">Filmler</option>
                <option value="{{ route('kitaps.index') }}">Kitaplar</option>
            </select>
        @endif    
    </div>
    <header>
        <h1>Film ve Kitap Yorumları</h1>
        @if(auth()->user()->hasRole('admin'))
        
        <script>
            function handleSelectChange(selectElement) {
                const selectedValue = selectElement.value;
                if (selectedValue) {
                    window.location.href = selectedValue; // Seçilen değere yönlendir
                }
            }
        </script>
        
        @endif
            
            <div class="d-flex justify-content end mb-4">
                <a class="menu-item"><button class="menu-container">Kullanıcı:<strong>@auth{{auth()->user()->name}}@endauth</strong></button></a>
                <a href="/logout" class="menu-item"><button class="menu-container">🔒Logout</button></a> 
            </div>              
           
        
    </header>
    <main>
        
        <div class="carousel">
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <div class="carousel-container">
                <div class="carousel-slide">
                    @if(isset($filmler) && count($filmler) > 0)
                        @foreach($filmler as $film)
                            <div class="item">
                                @if($film->cover_image)
                                    <img src="{{ asset('storage/' . $film->cover_image) }}" alt="{{ $film->title }} Kapak Resmi" class="cover-image">
                                @else
                                    <p>Kapak resmi mevcut değil.</p>
                                @endif
                                <div class="film-info">
                                    <p class="film-info"><strong>{{ $film->title }}</strong></p>
                                    <p class="film-info"><strong>Açıklama:</strong> {{ $film->description }}</p>
                                    <p class="film-info"><strong>Yazar:</strong> {{ $film->author ?? 'Yazar bilgisi mevcut değil.' }}</p>
                                    <p><strong>Tür:</strong> {{ $film->genre ?? 'Tür bilgisi mevcut değil.' }}</p>
                                    <a href="{{ route('films.show', $film->id) }}"><button>Yorumlar</button></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Hiç film bulunamadı.</p>
                    @endif
                </div>
            </div>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
   
        <div class="carousel">
            <button class="prev" onclick="moveSlidekitap(-1)">&#10094;</button>
            <div class="carousel-container">
                <div class="carousel-slidekitap">
                    @if(isset($kitaplar) && count($kitaplar) > 0)
                        @foreach($kitaplar as $kitap)
                            <div class="item">
                                @if($kitap->cover_image)
                                    <img src="{{ asset('storage/' . $kitap->cover_image) }}" alt="{{ $kitap->title }} Kapak Resmi" class="cover-image">
                                @else
                                    <p>Kapak resmi mevcut değil.</p>
                                @endif
                                <div class="film-info">
                                    <h2 class="sec_">{{ $kitap->title }}</h2>
                                    <p class="film-info"><strong>Açıklama:</strong> {{ $kitap->description }}</p>
                                    <p><strong>Yazar:</strong> {{ $kitap->author ?? 'Yazar bilgisi mevcut değil.' }}</p>
                                    <p><strong>Tür:</strong> {{ $kitap->genre ?? 'Tür bilgisi mevcut değil.' }}</p>
                                    <a href="{{ route('kitaps.show', $kitap->id) }}"><button>Yorumlar</button></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Hiç film bulunamadı.</p>
                    @endif
                </div>
            </div>
            <button class="next" onclick="moveSlidekitap(1)">&#10095;</button>
        </div>
    
        <script>
            let currentIndex = 0;
            let currentIndexKitap = 0;
            function moveSlide(direction) {
                const slides = document.querySelector('.carousel-slide');
                const totalSlides = slides.children.length;
                
                currentIndex += direction;
            
                if (currentIndex < 0) {
                    currentIndex = totalSlides - 1; // Son slayta git
                } else if (currentIndex >= totalSlides) {
                    currentIndex = 0; // İlk slayta git
                }
            
                const offset = -currentIndex * (915 / 5); // 924px genişlikte 5 film
                slides.style.transform = `translateX(${offset}px)`;
            }
            
        
            function moveSlidekitap(direction) {
                const slides = document.querySelector('.carousel-slidekitap');
                const totalSlides = slides.children.length;
                
                currentIndexKitap += direction;
            
                if (currentIndexKitap < 0) {
                    currentIndexKitap = totalSlides - 1; // Son slayta git
                } else if (currentIndexKitap >= totalSlides) {
                    currentIndexKitap = 0; // İlk slayta git
                }
            
                const offset = -currentIndexKitap * (915 / 5); // 924px genişlikte 5 film
                slides.style.transform = `translateX(${offset}px)`;
            }
            </script>    
    </main>
    
    <footer>
        <p>&copy; 2023 Film ve Kitap Yorumları</p>
    </footer>
</body>


</html>

