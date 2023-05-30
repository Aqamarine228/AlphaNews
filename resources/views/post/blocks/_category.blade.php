<div class="card">
    <div class="card-header">
        <h3 class="card-title">Category</h3>
    </div>
    <div class="card-body">
        <form id="post-update-category" action="{{ route('posts.update.category', $post->id) }}" method="post">
            @csrf
            @method('put')

            @include('alphanews::components.input_group', [
                 'type' => 'select',
                 'name' => \Illuminate\Support\Facades\Config::get('alphanews.foreign_keys.post_category'),
                 'required' => true,
                 'label' => false,
                 'items' => $categories,
                 'defaultValue' => $post->post_category_id,
             ])

        </form>
    </div>
    <div class="card-footer">
        <button form="post-update-category" class="btn btn-primary">Save</button>
    </div>
</div>
