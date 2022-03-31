<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @foreach ($breadcrumbs as $key => $url)
            @if(is_string($key) && !is_numeric($key))
            <li class="breadcrumb-item {{ (ltrim(request()->getPathInfo(), '/') === $url) ? 'active' : '' }}" {{ (ltrim(request()->getPathInfo(), '/') == $url) ? 'aria-current="page"' : "" }}><a href="{{ url($url) }}">{{ucfirst($key)}}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
