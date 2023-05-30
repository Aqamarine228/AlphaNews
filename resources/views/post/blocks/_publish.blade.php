<div class="card">
    <div class="card-header">
        Publish
    </div>

    @if (!$post->isPublished())
        <div class="card-body">
            <form id="post-publish" action="{{ route('posts.publish', $post->id) }}" method="post">
                @csrf
                @include('alphanews::components.input_group', [
                    'type' => 'text',
                    'name' => 'date',
                    'required' => false,
                    'label' => false,
                    'placeholder' => 'Published at',
                    'defaultValue' => now()->toDateString()
                ])
            </form>
        </div>
    @endif

    <div class="card-footer">
        @if (!$post->isPublished())
            <button form="post-publish" class="btn btn-outline-success">Publish</button>
        @else
            <form action="{{ route('posts.unpublish', $post->id) }}" method="post">
                @csrf
                <button class="btn btn-outline-warning">Hide</button>
            </form>
        @endif
    </div>
</div>
