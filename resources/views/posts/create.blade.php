<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="body">Body:</label>
    <textarea name="body" id="body" required></textarea>

    <label for="hashtags">Hashtags (comma-separated):</label>
    <input type="text" name="hashtags" id="hashtags">

    <button type="submit">Create Post</button>
</form>
