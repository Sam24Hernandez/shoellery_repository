<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shoellery') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>               
    <script src="{{ asset('js/main.js') }}"></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

    @stack('styles')

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
    <body>       
        @include('sweetalert::alert')        
        <div id="app">
            <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand title" href="{{ url('/') }}">                        
                        <p>
                            Shoe<span class="word wisteria">llery</span>
                            <!--<span class="word belize">nstagram</span>-->
                            <span class="word belize">picture</span>
                        </p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>                      

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li id="wvh-shoellery" class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('¿Qué es Shoellery?') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li id="wvh-welcome" class="nav-item">
                                <a class="nav-link" href="{{ route('pages.welcome') }}">{{ __('Shoellery') }}</a>
                            </li>
                            @endif

                            @else                                               
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <i class="fa fa-home fa-lg" aria-hidden="true"></i>
                                </a>
                            </li>                            
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('gente*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                                    <i class="fa fa-globe fa-lg" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('upload-photo') ? 'active' : '' }}" href="{{ route('image.create') }}">
                                    <i class="fas fa-folder-plus fa-lg" aria-hidden="true"></i>
                                </a> 
                            </li>   

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('likes') ? 'active' : '' }}" href="{{ route('likes') }}">
                                    <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
                                </a> 
                            </li>                          
                        
                            <li id="cog-shoellery" class="nav-item dropdown">
                                @if(Auth::user()->image)
                                <div class="container-avatar-profile">
                                    <a style="cursor: pointer;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expandend="false" title="Mi perfil" v-pre>                                    	
                                    	           
                                        <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" />
                                                                  
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                            <i class="fa fa-user" aria-hidden="true"></i> Perfil
                                        </a>
                                        <a class="dropdown-item" href="{{ route('config') }}">
                                            <i class="fa fa-cog" aria-hidden="true"></i> Configuración
                                        </a>
                                        
                                        <button class="switch" id="switch">
                                            <span><i class="fas fa-sun" aria-hidden="true"></i></span>
                                            <span><i class="fas fa-moon" aria-hidden="true"></i></span>
                                        </button> 

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                                @else
                                <div class="container-avatar-profile">
                                    <a style="cursor: pointer;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expandend="false" title="Mi perfil" v-pre>                                    	
                                    	           
                                      <img src="{{ url('/img/user.png') }}" />
                                                                  
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                            Perfil
                                        </a>
                                        <a class="dropdown-item" href="{{ route('config') }}">
                                            Configuración
                                        </a>

                                        <button class="switch" id="switch">
                                            <span><i class="fas fa-sun" aria-hidden="true"></i></span>
                                            <span><i class="fas fa-moon" aria-hidden="true"></i></span>
                                        </button>                                        

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </div>                                
                                @endif                                

                            </li>                                                   
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
                                            

            <main class="py-4">
                @yield('content')
            </main>            

            <footer class="main-footer">              
                <strong>&copy; 2020 <a href="{{ route('home') }}">SHOELLERY</a></strong> FROM SAM&exist;STUDIOS
            </footer>
        </div>   

        <!--JQUERY-->
        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> 
        @stack('scripts')    
    </body>
</html>

