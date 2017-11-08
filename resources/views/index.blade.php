<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div style="background: url('{{ $contest['photo_path'] }}') no-repeat center center; background-size: cover;" class="flex-center position-ref full-height">
        @include('includes.header')
        {{-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> --}}
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="modal-content">
                <p>Invite your friends.</p>
                <form action="">
                    <label for="">Friends emailadres</label>
                    <input type="text" name="email" placeholder="E-mail">
                </form>
              </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title m-b-md">{{ $contest['title'] }}</div>
                        <div class="description">{!! $contest['content'] !!}</div>
                        @if(!Auth::check())
                            <a href="{{ route('register') }}">Create Account</a>
                            <a href="{{ route('contest.index') }}">Contest</a>
                        @endif

                        @if(Auth::check())
                            <a href="{{ route('contest.index') }}">Contest</a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div id="winners">
                <div class="winner-cards">
                    @foreach($winners as $winner)
                        <div class="winner">
                            <div class="thumb">
                                <img src="{{ $winner['photo_path'] }}" alt="">
                            </div>
                            <div class="content">
                                <div class="name">
                                    {{ $winner['firstname'] }} {{ $winner['lastname'] }}
                                </div>
                                <div class="contest">
                                    {{ $winner['title'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        </div>
        <section id="how">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="image">
                            <h1>1.</h1>
                        </div>
                        <div class="content">
                            <div class="inner">
                                <h2>1. Cook your meal</h2>
                                <span></span>
                                <p>
                                    Obviously, the first task is to cook your favourite meal.
                                    It can be an egg, your favourite food or your grandma's recipe.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="content">
                            <div class="inner">
                                <h2>2. Present your meal</h2>
                                <span></span>
                                <p>
                                    After your meal is cooked, you need to present your meal on a plate, 
                                    in a glass, in a bucket. Use your imagination.
                                </p>
                                </div>
                        </div>
                        <div class="image">
                            <h1>2.</h1>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="image">
                            <h1>3.</h1>
                        </div>
                        <div class="content">
                            <div class="inner">
                                <h2>3. Photograph your meal</h2>
                                <span></span>
                                <p>
                                    After your meal is presented on a nice plate. This is the right time to photograph your piece of art.
                                    Upload your image to start with the contest, maybe you'll win this.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            footer
        </footer>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script>
            // $(document).ready(function(){
            //     //initialize all modals           
            //     $('.modal').modal();

            //     //now you can open modal from code
            //     $('#modal1').modal('open');
            // });
        </script>
    </body>
</html>