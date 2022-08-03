<button class="btn btn-sm bg-primary d-inline">
    <a href="{{ route('alphanews.posts.edit', $post->id) }}"><em class="fas fa-eye"></em> Edit </a>
</button>

@if ($post->isPublished())
    @if(!$post->is_trending_now)
        <button form="post-top-{{ $post->id }}" class="btn-sm btn bg-info">
            <em class="fas fa-arrow-up"></em> Add To Top
        </button>
    @else
        <span class="btn-sm btn bg-gradient-danger hover"><em class="fab fa-hotjar"></em> On Top Now</span>
    @endif

@endif

<button form="post-destroy-{{ $post->id }}"
        class="btn btn-sm bg-danger d-inline" data-ask="1" data-title="Delete post"
        data-message="Are you sure you want to delete this post - '{{ $post->title }}'">
    <em class="fas fa-trash"></em> Delete
</button>


@if ($post->isPublished() && !$post->is_trending_now)
    <form id="post-top-{{ $post->id }}" action="{{ route('alphanews.posts.update.main', $post->id) }}" method="POST"
          class="d-inline">
        @csrf
        @method('put')
    </form>
@endif
<form id="post-destroy-{{ $post->id }}" action="{{ route('alphanews.posts.destroy', $post->id) }}" method="post">
    @csrf
    @method('delete')
</form>
