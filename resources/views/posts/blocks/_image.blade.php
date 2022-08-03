<div class="card">
    <div class="card-header">
        <h3 class="card-title">Image</h3>
    </div>
    <div class="card-body">
        <form id="post-update-image" action="{{ route('alphanews.posts.update.image', $post->id) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('put')
            <input id="x1" type="hidden" name="x1">
            <input id="y1" type="hidden" name="y1">
            <input id="width" type="hidden" name="width">
            <input id="height" type="hidden" name="height">
            @include('alphanews::components.input_group', [
               'type' => 'file',
               'name' => 'picture',
               'required' => true,
               'label' => false,
            ])

        </form>
    </div>
    <div class="card-footer">
        <button form="post-update-image" class="btn btn-primary">Upload</button>
    </div>
    @if ($post->picture)
        <div class="card-body">
            <img class="img-fluid" src="{{ $post->originalImage() }}" alt="">
        </div>
    @endif
</div>
