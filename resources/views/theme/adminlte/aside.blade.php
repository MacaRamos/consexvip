<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-white elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link bg-white" style="height: 57px;">
    {{-- <img src="{{asset("assets/img/logoInicial.png")}}" alt="Alfredo" class="brand-image" width="34" height="34">
    --}}
    {{-- <img src="{{asset("assets/img/logo_veramonte_aside.png")}}" alt="Logo" class="pl-3" style="opacity: .8"
    width="170px" height="auto"> --}}
    <span class="brand-text font-weight-light ml-3">Marketplace</span>
    {{--     
    <img src="{{asset("assets/img/logo-white.png")}}" width="auto" height="34" class="pl-3"> --}}
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="image">
        <img src="{{asset("assets/img/Avatar.png")}}" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block">{{Auth::user()->name ?? ''}}</a>
  </div>
  </div> --}}
  <!-- Sidebar Buscador -->
  <div class="form-inline mt-3">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="¿Qué desea buscar?"
        aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">Lo + buscado</li>
      @foreach ($menusComposer as $item)
      @if ($item["menu_anterior"] != 0)
      @break
      @endif
      @include("theme.$theme.menu-item", ["item" => $item])
      @endforeach
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
  <!-- Publicar anuncio -->
  {{-- @if (!is_null(Auth::user())) --}}
  <a href="{{route('publicacion.create')}}" class="btn btn-block btn-primary btn-lg text-white text-bold">
    <i class="fas fa-plus"></i> Publicar Anuncio
  </a>
  {{-- @endif --}}
  </div>
  <!-- /.sidebar -->
</aside>