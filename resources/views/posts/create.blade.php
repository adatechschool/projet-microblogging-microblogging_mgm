<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <div class="form-group">
    <label for="body">Body:</label>
    <textarea name="body" id="body" required></textarea>
    </div>

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
    </div>

    <label for="hashtags">Hashtags (comma-separated):</label>
    <input type="text" name="hashtags" id="hashtags">

    <button type="submit">Create Post</button>
</form>