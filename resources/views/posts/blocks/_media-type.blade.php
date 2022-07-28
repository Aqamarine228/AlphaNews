<div class="card">
    <div class="card-header">
        <h3 class="card-title">Media Type</h3>
    </div>
    <div class="card-body">
        <form id="post-update-media" action="{{ route('alphanews.posts.update.media-type', $post->id) }}" method="post">
            @csrf
            @method('put')

            @include('alphanews::components.input_group', [
                 'type' => 'select',
                 'name' => 'media_type',
                 'required' => true,
                 'label' => false,
                 'items' => $postMediaTypes,
                 'defaultValue' => $post->media_type,
             ])

        </form>
    </div>
    <div class="card-footer">
        <button form="post-update-media" class="btn btn-primary">Save</button>
    </div>
</div>
