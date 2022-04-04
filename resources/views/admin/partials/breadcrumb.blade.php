<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        @foreach (breadcrumbs() as $key => $url)
            @if(is_string($key) && !is_numeric($key))
                @if(in_array($key, config('constants.hide_breadcurmbs')))
                    @continue
                @endif
                @if(request()->route()->named("admin.settings.change") && $key == 'change')
                    @php $key = 'Setting Change'; @endphp
                @endif
            <li class="breadcrumb-item {{ (ltrim(request()->getPathInfo(), '/') === $url) ? 'active' : '' }}" {{ (ltrim(request()->getPathInfo(), '/') == $url) ? 'aria-current="page"' : "" }}>
                @if(ltrim(request()->getPathInfo(), '/') == $url)
                <a>{{ucwords(str_replace('-', ' ', str()->singular($key)))}}</a></li>
                @else
                    <a href="{{ url($url) }}">{{ucwords(str_replace('-', ' ', str()->singular($key)))}}</a></li>
                @endif
                    
            @endif
        @endforeach
    </ol>
</nav>
