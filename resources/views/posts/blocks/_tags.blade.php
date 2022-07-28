<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tags</h3>
    </div>
    <div class="card-body">
        <form id="post-update-tags" action="{{ route('alphanews.posts.update.tags', $post->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="step_method" value="updateStep5">
            @include('alphanews::components.input_group', [
                'type' => 'select',
                'name' => 'tags[]',
                'id' => 'tags',
                'label' => false,
                'optionName' => 'tag',
                'optionId' => 'tag',
                'multiple' => true,
                'items' => $postTags, // для вывода значений по умолчанию
                'defaultValue' => $postTags, // для вывода значений по умолчанию
            ])

        </form>
    </div>
    <div class="card-footer">
        <button form="post-update-tags" class="btn btn-primary">Update</button>
    </div>
</div>