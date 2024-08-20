<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" id="photo" name="photo" class="form-control">
    </div>

    <div class="form-group">
        <label for="hashtags">Hashtags (comma separated)</label>
        <input type="text" id="hashtags" name="hashtags" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>