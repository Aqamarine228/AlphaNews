<div class="card">
    <div class="card-header">
        Details
    </div>
    <div class="card-body">
        <div>
            <b> <i class="fa fa-eye"></i> Visibility:</b>
            @if ($post->isPublished())
                Visible
            @else
                Hidden
            @endif
        </div>
        <div>
            <b> <i class="fa fa-calendar"></i> Created at:</b>
            {{ $post->created_at->diffForHumans() }}
        </div>
        <div>
            <b> <i class="fa fa-calendar"></i> Updated at:</b>
            {{ $post->created_at->diffForHumans() }}
        </div>
        @if ($post->published_at !== null)
            <div>
                <b> <i class="fa fa-calendar"></i> Published at:</b>
                {{ $post->published_at->diffForHumans() }}
            </div>
        @endif

    </div>


    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-danger text-right">Delete</button>
            </div>
        </div>
    </div>

</div>
