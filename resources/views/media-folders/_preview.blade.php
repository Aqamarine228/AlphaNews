<div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
    <div class="card full-height">
        <div class="card-body text-center">
            {{ $adds ?? '' }}
            <div>
                <a href="{{ $link }}">
                    {{ $slot }}
                </a>
            </div>
            <div>
                <a href="{{ $link }}">
                    <span>{{ $title }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
