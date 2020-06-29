<div class="row">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Menampilkan</div>
            </div>
            <select class="form-control w-25" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                @foreach([5, 10, 25, 50] as $limiter)
                    <option value="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['limit' => $limiter])) }}" @if(request('limit', 10) == $limiter) selected @endif>{{ $limiter }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">baris</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if ($paginator->hasPages())
            <div class="input-group">
                <div class="input-group-prepend">
                    <a class="input-group-btn btn btn-outline-secondary {{ request('page') <= 1 ? 'disabled' : 'text-success' }}" style="font-size:12pt; line-height: 1.3rem;" href="{{ $paginator->url(1) }}">&laquo;</a>
                    <a class="input-group-btn btn btn-outline-secondary {{ request('page') <= 1 ? 'disabled' : 'text-success' }}" style="font-size:12pt; line-height: 1.3rem;" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
                    <div class="input-group-text">Halaman</div>
                </div>
                <select class="form-control w-25" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    @for($page = 1; $page <= $paginator->lastPage(); $page++)
                    <option value="{{ $paginator->url($page) }}" @if(request('page') == $page) selected @endif>{{ $page }}</option>
                    @endfor
                </select>
                <div class="input-group-append">
                    <a class="input-group-btn btn btn-outline-secondary {{ request('page') >= $paginator->lastPage() ? 'disabled' : 'text-success' }}" style="font-size:12pt; line-height: 1.3rem;" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
                    <a class="input-group-btn btn btn-outline-secondary {{ request('page') >= $paginator->lastPage() ? 'disabled' : 'text-success' }}" style="font-size:12pt; line-height: 1.3rem;" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
                </div>
            </div>
        @endif
    </div>
</div>
