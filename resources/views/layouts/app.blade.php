<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>               
        <script src="{{ asset('js/main.js') }}"></script> 
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="{{URL('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    </head>
    <body> 
        <div id="app">
            <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand title" href="{{ route('home') }}">                        
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
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
                            <li>
                                @if(Auth::user()->image)
                                <div class="container-avatar-profile">
                                    <a title="Mi perfil" href="{{ route('profile', ['id' => Auth::user()->id]) }}">                                    	
                                    	           
                                        <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" />
                                                                  
                                    </a>
                                </div>
                                @else
                                <div class="container-avatar-profile">
                                    <a title="Mi perfil" href="{{ route('profile', ['id' => Auth::user()->id]) }}">                                    	
                                    	           
                                      <img src="{{ url('/img/user.png') }}" />
                                                                  
                                    </a>
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
                <strong>&copy; 2020 <a href="{{ route('home') }}">SHOELLERY</a></strong> FROM SAM HERNANDEZ
            </footer>
        </div>   

        <!--JQUERY-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    

        @stack('scripts')      
               
    </body>
</html>

