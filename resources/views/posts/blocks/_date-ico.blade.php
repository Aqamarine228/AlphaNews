@if($post[\Illuminate\Support\Facades\Config::get('alphanews.foreign_keys.post_category')] == \Illuminate\Support\Facades\Config::get('alphanews.posts.categories_ido'))
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Date ICO</h3>
        </div>
        <div class="card-body">
            <form id="post-update-date-ico" action="{{ route('alphanews.posts.update.dateico', $post->id) }}" method="post">
                @csrf
                @method('put')

                @include('admin::components.input_group', [
                     'type' => 'text',
                     'name' => 'date_ico',
                     'label' => 'Date-Ico',
                     'required' => true,
                     'placeholder' => 'Date ICO',
                     'defaultValue' => $post->date_ico,
                 ])
            </form>
        </div>
        <div class="card-footer">
            <button form="post-update-date-ico" class="btn btn-primary">Save</button>
        </div>
    </div>
@endif
