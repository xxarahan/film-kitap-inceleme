<div class="admin-container">
    <h1 class="text-center">Tüm Kitaplar</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->hasRole('admin'))
    <div class="admin-actions">
        <a href="{{ route('kitaps.create') }}" class="btn btn-primary"><button> Kitap Ekle</button></a>
        <a href="{{ route('kitaps.index') }}" class="btn btn-secondary"><button> Görüntüle</button></a>
        <a href="{{route('layout')}}"><button>Anasayfaya dön</button></a>
    </div>
    @endif
    @if($kitaplar->isEmpty())
        <p class="text-center">Henüz kitap bulunmamaktadır.</p>
    @else
        <div class="kitap-list">
            @foreach($kitaplar as $kitap)
                <div class="kitap-card">
                    
                    <h2>{{ $kitap->title }}</h2>
                    <p><strong>Açıklama:</strong> {{ $kitap->description }}</p>
                    <p><strong>Yazar:</strong> {{ $kitap->author ?? 'Yazar bilgisi mevcut değil.' }}</p>
                    <p><strong>Tür:</strong> {{ $kitap->genre ?? 'Tür bilgisi mevcut değil.' }}</p>
                    @if($kitap->cover_image)
                        <img src="{{ asset('storage/' . $kitap->cover_image) }}" alt="{{ $kitap->title }} Kapak Resmi" class="kitap-cover">
                    @else
                        <p>Kapak resmi mevcut değil.</p>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <form action="{{ route('kitap.sil', $kitap->id) }}" method="POST" onsubmit="return confirm('Bu kitabı silmek istediğinize');">
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
    .kitap-section {
        padding: 20px;
    }
    .kitap-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .kitap-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        width: 200px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        
    }
    .kitap-cover {
        max-width: 100%;
        border-radius: 4px;
    }

</style>

