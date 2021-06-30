<nav class="navbar navbar-expand-lg p-3 px-xl-5 row">
    <a class="navbar-brand d-flex" href="index.html">
        <h2 class="mr-2"><span>Funko</span> King</h2>
        <i id="crown" class="fas fa-crown"></i>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link mr-md-3 mx-xl-5" href="{{route('index')}}">Home <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-md-3 mr-xl-5" href="{{route('shop')}}">Shop!</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-md-3 mr-xl-5" href="{{route('blog')}}">Blog</a>
            </li>
            <li class="nav-item">
                <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link mr-md-3 mr-xl-5" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
              {{--  @foreach($user->roles as $role)
                    @if($role->id == 1)--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              {{--  <a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a>--}}
                                <a class="dropdown-item" href="{{ route('account') }}">Account</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                 {{--   @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('account') }}">Account</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endif
                        @endforeach--}}
                        @endguest
                        </li>
        </ul>
       {{-- <div class="h-100">
            <div class="d-flex h-100 mb-3 mb-lg-0 mr-lg-3">
                <div class="searchbar">
                    <input class="search_input" type="text" name="search-bar" placeholder="Search...">
                    <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                </div>
            </div>
        </div>--}}
        <a href="{{ route('winkelwagen') }}" data-toggle="tooltip" data-placement="bottom" title="Winkelwagen">
            <i class="fas fa-shopping-cart fa-2x"></i>
            <!-- Wordt niet getoond indien er geen items in winkelwagen zitten -->
            {{--@if(Session::has('cart')->totalQuantity > 0)--}}
            <span class="badge badge-pill badge-success">{{ Session::has('cart') ? Session::get('cart')->totalQuantity : '0' }}</span>
            {{--@endif--}}

        </a>
    </div>
</nav>
