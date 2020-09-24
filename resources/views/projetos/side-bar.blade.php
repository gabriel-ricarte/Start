<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('projeto.index')}}">
         <div class="sidebar-brand-icon ">
         <!--  <i class="fas fa-circle-notch"></i> -->
          <img src="../../images/logoStart.png" style="max-width: 100px;max-height: 90px">
        </div>
        <!-- <div class="sidebar-brand-text mx-3">START</div> -->

      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @yield('dashA')">
        <a class="nav-link" href="{{route('projeto.index')}}">
          <i class="fas fa-gamepad"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        permissões
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @yield('perfilA')">
        <a class="nav-link " href="{{route('perfil')}}">
          <i class="fa fa-user"></i>
          <span>Perfil</span></a>
      </li>
      <li class="nav-item @yield('usersA')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users-cog"></i>
          <span>Usuários</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Controle de Usuários:</h6>
            <a class="collapse-item" href="{{route('admins.index')}}">Admins</a>
            <!-- <a class="collapse-item" href="{{route('tecnicos.index')}}">Tecnicos</a> -->
            <a class="collapse-item" href="" data-toggle="modal" data-target="#oops">Todos</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item @yield('equipeA')">
        <a class="nav-link " href="{{route('equipe.index')}}">
          <i class="fa fa-users"></i>
          <span>Gerenciamento de Equipes</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        projetos
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @yield('projetoA')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSimulador" aria-expanded="true" aria-controls="collapseSimulador">
          <i class="fas fa-project-diagram"></i>
          <span>Gerência de Projetos</span>
        </a>
        <div id="collapseSimulador" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Seus Projetos:</h6>
            
            <a class="collapse-item" href="" data-toggle="modal" data-target="#oops">Finalizados</a>
            <a class="collapse-item" href="" data-toggle="modal" data-target="#oops">Em Andamento</a>
            <a class="collapse-item" href="" data-toggle="modal" data-target="#oops">Novo Projeto</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Todos os Projetos:</h6>
            <a class="collapse-item btn btn-danger text-white" href="#" data-toggle="modal" data-target="#oops">Finalizados</a>
            <a class="collapse-item btn btn-info text-white" href="" data-toggle="modal" data-target="#oops">Em Andamento</a>
          </div>
        </div>
      </li>
     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
           <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>