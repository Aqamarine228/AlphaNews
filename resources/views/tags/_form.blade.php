<form action="{{ route('alphanews.tags.store') }}" method="POST">

    @csrf

    @include('alphanews::components.input_group', [
        'type' => 'text',
        'required' => true,
        'label' => 'Name',
        'name' => 'name',
        'placeholder' => 'Tag',
    ])

    <button class="btn btn-primary">
        <i class="fa fa-save"></i>
        Save
    </button>
</form>
