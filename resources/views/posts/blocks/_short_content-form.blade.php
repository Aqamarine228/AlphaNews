<form action="{{ route('alphanews.posts.update.preview', $post->id) }}" method="post">
    @csrf
    @method('put')
    @include('alphanews::components.input_group', [
       'type' => 'textarea',
       'name' => 'short_title',
       'required' => true,
       'label' => 'Short Title',
       'rows' => 3,
       'defaultValue' => $post->short_title
    ])

    @include('alphanews::components.input_group', [
       'type' => 'textarea',
       'name' => 'short_content',
       'required' => true,
       'label' => 'Short Content',
       'defaultValue' => $post->short_content
   ])

    <button class="btn btn-primary">Next</button>

</form>
