<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md bg-header border-0">
  <div class="container">
    <a href="../../index3.html" class="navbar-brand">
      <span class="brand-text font-weight-ligh text-white" style="letter-spacing: 3px; font-size: 28px;">CONSEXVIP</span>
    </a>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="font-size: 11px;">

      <li class="nav-item">
        <a href="{{route('inicio')}}" class="nav-link d-flex align-items-center" id="inicio">inicio</a>
      </li>
      <li class="nav-item">
        @if (!is_null(Auth::user()))
        <a href="{{route('anuncios.index')}}" class="nav-link d-flex align-items-center" id="anuncios.create">anuncios</a>
        @else
        <a href="#" class="nav-link d-flex align-items-center" id="comoPublicar">como publicar</a>
        @endif
      </li>
      <li class="nav-item">
        @if (!is_null(Auth::user()))
        <a href="#" class="nav-link d-flex align-items-center" id="blog.create">blog</a>
        @else
        <a href="#" class="nav-link d-flex align-items-center" id="blog">blog</a>
        @endif
      </li>
      @if (!is_null(Auth::user()))
      <li class="nav-item dropdown user user-menu">
        <a class="nav-link pull-right float-right d-flex align-items-center" data-toggle="dropdown" href="#">
          <span class="mr-2 align-middle">
            {{Auth::user()->username ?? ''}}
          </span>
          Administrador
          {{-- <img src="{{asset("assets/img/Avatar.png")}}" class="img-circle hover-brightness " width="36"
          height="36"> --}}
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <!-- User image -->
          <li class="user-header" style="height: auto; border-bottom: 1px solid #e9ecef;">
            <p>
              {{Auth::user()->name ?? ''}}
            </p>
            <p>
              @if (isset(Auth::user()->roles))
              @foreach (Auth::user()->roles as $rol)
              @if ($loop->last)
              {{$rol->nombre}}
              @else
              {{$rol->nombre}} -
              @endif
              @endforeach
              @endif
            </p>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" style="font-size: 13px;">
              <i class="fas fa-sign-out-alt"></i> Salir
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </li>
        </ul>
      </li>
      @endif
    </ul>
  </div>
</nav>
<!-- /.navbar -->