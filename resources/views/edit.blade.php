<form action="{{ route('update', $film->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Güncelleme işlemi için PUT metodunu kullanıyoruz -->
    
    <label for="title">Film Başlığı:</label>
    <input type="text" name="title" id="title" value="{{ $film->title }}" required>
    
    <label for="description">Açıklama:</label>
    <textarea name="description" id="description" required>{{ $film->description }}</textarea>
    
    <label for="cover_image">Kapak Resmi Yükle:</label>
    <input type="file" name="cover_image" id="cover_image" accept="image/*">
    <p>Mevcut Kapak Resmi: <img src="{{ asset($film->cover_image) }}" alt="Kapak Resmi" width="100"></p>
    
    <button type="submit">Güncelle</button>
</form>