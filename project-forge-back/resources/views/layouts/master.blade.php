<!doctype html>
<html lang="en">

<head>
    <title>Tasks Managment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }}"> --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="wrapper d-flex align-items-stretch" id="app">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5"
                    style="background-image: url(images/tasks.png);"></a>
                <ul class="list-unstyled components mb-5 ">
                    @can('admin')
                    <li class="{{ (request()->is('departments') || 
                                   request()->is('users')) ? 'active' : '' 
                                }}">
                        <a href="#homeSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('departments') || 
                                                                                                            request()->is('users')) ? 'true' : 'false' 
                                                                                                        }}"
                            aria-controls="homeSubmenu">

                            Management
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="collapse list-unstyled {{ (request()->is('departments') || 
                                                             request()->is('users')) ? 'show' : '' 
                                                            }} " 
                             id="homeSubmenu">
                            @can('departments-read')
                            <li class="{{ request()->is('departments') ? 'active' : '' }}">
                                <a href="{{ route('departments.index') }}">Departments</a>
                            </li>
                            @endcan
                            @can('users-read')
                            <li class="{{ request()->is('users') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}">Users</a>
                            </li>
                            @endcan
                            @can('roles-read')
                            <li>
                                <a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                            @endcan
                            @can('permissions-read')
                            <li>
                                <a href="{{ route('permissions.index') }}">Permissions</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    <li>
                        <a href="#">Tasks Inbox</a>
                    </li>
                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        2024 All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href=""
                            target="_blank">rqia</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" id="navCollapse">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Settings</a>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
</body>

</html>
