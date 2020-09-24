<nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
 <a class="navbar-brand" href="{{route('inicio')}}">
    <img src="../../images/logo teste.png" style="max-width: 150px;max-height: 150px">
    <!--  JANGADEIRO -->
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
@guest
<div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto" style="float: right">
        <li class="nav-item ">
            <a class="nav-link" href="{{route('login')}}"><button @yield('login') class="btn btn-primary">LOGIN</button></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{route('register')}}"><button @yield('cadastro') class="btn btn-primary">CADASTRO</button></a>
        </li>
    </ul>
</div>
@endguest
</nav>
