<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{--<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>--}}


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extras')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">

                                <a class= "nav-link dropdown-toggle" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Operations
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('subject.create')}}">Add Subject</a>
                                    <a class="dropdown-item" href="{{route('stream.create')}}"> Add Stream</a>
                                    <a class="dropdown-item" href="{{route('year.create')}}">Add Year</a>
                                    <a class="dropdown-item" href="{{route('exam.create')}}">Add Exam</a>
                                    <a class="dropdown-item" href="{{route('class.create')}}">Add Class</a>
                                    <a class="dropdown-item" href="{{route('term.create')}}">Add Term</a>
                                    <a class="dropdown-item" href="{{route('grade.create')}}">Add Grade</a>
                                    <a class="dropdown-item" href="{{route('subjectteacher.create')}}">Add Teachers Subjects</a>
                                    <a class="dropdown-item" href="{{route('studentsubject.create')}}">Add single Student Subjects</a>
                                    <a class="dropdown-item" href="{{route('contact.create')}}">Add Contact</a>
                                    <a class="dropdown-item" href="{{route('student.create')}}">Add Student</a>
                                    <a class="dropdown-item" href="{{route('guardian.create')}}">Add Guardian</a>
                                    <a class="dropdown-item" href="{{route('mass')}}">Form Assign Subjects</a>
                                    <a class="dropdown-item" href="{{route('groupAssign')}}">Mass Assign Subjects</a>
                                </div>

                            </li>
                            <li class="nav-item dropdown">

                                <a class= "nav-link dropdown-toggle" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Results
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('streamresults')}}">Stream Results</a>
                                    <a class="dropdown-item" href="{{route('class_results')}}"> All Results</a>

                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('substudents') }}"> Students doing  subjects</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resultupload') }}">Upload Results</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('uncommitted') }}">Uncomitted results</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('substudents') }}">Score Fillable sheets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.upload') }}">Upload Students</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>



                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @yield('scripts')

        </main>
    </div>
</body>
</html>
