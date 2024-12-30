<div class="admin-container">
    <h1 class="text-center">Tüm Filmler</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->hasRole('admin'))
    <div class="admin-actions">
        <a href="{{ route('films.create') }}" class="btn btn-primary"><button> Film Ekle</button></a>
        <a href="{{ route('films.index') }}" class="btn btn-secondary"><button> Görüntüle</button></a>
        <a href="{{route('layout')}}"><button>Anasayfaya dön</button></a>
    </div>
    @endif
    @if($filmler->isEmpty())
        <p class="text-center">Henüz film bulunmamaktadır.</p>
    @else
        <div class="film-list">
            @foreach($filmler as $film)
                <div class="film-card">
                    
                    <h2>{{ $film->title }}</h2>
                    <p><strong>Açıklama:</strong> {{ $film->description }}</p>
                    <p><strong>Yazar:</strong> {{ $film->author ?? 'Yazar bilgisi mevcut değil.' }}</p>
                    <p><strong>Tür:</strong> {{ $film->genre ?? 'Tür bilgisi mevcut değil.' }}</p>
                    @if($film->cover_image)
                        <img src="{{ asset('storage/' . $film->cover_image) }}" alt="{{ $film->title }} Kapak Resmi" class="film-cover">
                    @else
                        <p>Kapak resmi mevcut değil.</p>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <form action="{{ route('film.sil', $film->id) }}" method="POST" onsubmit="return confirm('Bu filmi silmek istediğinize');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Sil</button>
                    </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .film-section {
        padding: 20px;
    }
    .film-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .film-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        width: 200px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        
    }
    .film-cover {
        max-width: 100%;
        border-radius: 4px;
    }

</style>

