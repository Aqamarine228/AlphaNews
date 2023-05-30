@if(!$post->is_trending_now)
    <div class="card">
        <div class="card-header">
            Add to top
        </div>

        <div class="card-footer">
            <form action="{{ route('posts.update.main', $post->id) }}" method="post">
                @csrf
                @method('put')
                <button class="btn btn-outline-info" type="submit">Add to top</button>
            </form>
        </div>

    </div>
@endif
