<div class="container">
    <h1>Yeni Film Ekle</h1>
    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Film Başlığı</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Açıklama</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="author">Yazar</label>
            <input type="text" name="author" id="author" class="form-control">
        </div>
        <div class="form-group">
            <label for="genre">Tür</label>
            <input type="text" name="genre" id="genre" class="form-control">
        </div>
        <div class="form-group">
            <label for="cover_image">Kapak Resmi(önerilen:512x512)</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
</div>