<form action="{{ $model->exists ? route('alphanews.post-categories.update', $model->id) : route('alphanews.post-categories.store') }}" method="POST">

    @csrf
    @if ($model->exists)
        @method('PUT')
    @endif

    @include('alphanews::components.input_group', [
        'type' => 'text',
        'required' => true,
        'label' => 'Name',
        'name' => 'name',
        'placeholder' => 'Category',
        'defaultValue' => $model->name
    ])

    @include('alphanews::components.input_group', [
        'type' => 'color',
        'required' => true,
        'label' => 'Color',
        'name' => 'color',
        'placeholder' => '#dsfsadf',
        'defaultValue' => $model->color
    ])

    @include('alphanews::components.input_group', [
        'type' => 'select',
        'required' => true,
        'label' => 'Parent',
        'name' => 'parent_category_id',
        'items' => $categories,
        'defaultValue' => $model->parent_category_id ?? request()->get('category_id')
    ])

    <button class="btn btn-primary">
        <i class="fa fa-save"></i>
        Save
    </button>
</form>