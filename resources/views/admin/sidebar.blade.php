@php
    $items = [
        'home' => 'Dashboard',
        'developers' => 'Developers',
        'tasks' => 'Tasks',
        'providers' => 'Providers',
    ];
@endphp


    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <ul class="sidebar">
                    @foreach($items as $route => $title)
                        @if(is_null($title))
                            <li><hr/></li>
                            @continue(1)
                        @endif
                        <li>
                            @if(\Request::route()->getName() == "admin.$route.index" || \Request::route()->getName() == $route)
                                <li><b>{{ $title }}</b></li>
                            @else
                                @if(Route::has("admin.$route.index"))
                                    <li><a href="{{ route("admin.$route.index") }}">{{ $title }}</a></li>
                                @elseif(Route::has("$route.index"))
                                    <li><a href="{{ route("$route.index") }}">{{ $title }}</a></li>
                                @elseif(Route::has($route))
                                    <li><a href="{{ route($route) }}">{{ $title }}</a></li>
                                @else
                                    <li><a href="javascript:;">{{ $title }}</a></li>
                                @endif
                            @endif
                        </li>
                    @endforeach
                    <li><hr/></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
