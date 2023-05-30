<form action="{{ route('posts.update.content', $post->id) }}" method="post">
    @csrf
    @method('put')
    @include('alphanews::components.input_group', [
       'type' => 'textarea',
       'name' => 'title',
       'required' => true,
       'label' => 'Title',
       'rows' => 3,
       'defaultValue' => $post->title
    ])

    @include('alphanews::components.input_group', [
       'type' => 'textarea',
       'name' => 'content',
       'required' => true,
       'label' => 'Content',
       'defaultValue' => $post->content
   ])

    <button class="btn btn-primary">Save</button>

</form>
