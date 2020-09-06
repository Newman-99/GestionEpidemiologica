    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURL; ?>dashboard/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-hospital"></i>
        </div>
        <div class="sidebar-brand-text mx-3 small"><?php echo ORGANIZATION ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVERURL; ?>dashboard/">
          <i class="fas fa-bars"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Nav Item - Casos Epidemiologicos Collapse Menu -->
      <?php if ($_SESSION['idNivelPermiso'] == "1"): ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCasosEpidemi" aria-expanded="true" aria-controls="collapseCasosEpidemi">
          <i class="fas fa-file-medical"></i>
          <span>Casos Epidemilogicos</span>
        </a>
        <div id="collapseCasosEpidemi" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion de Casos:</h6>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>registerCasosEpidemi/">Lista de Casos</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>registerCasosEpidemi/">Registro de Casos</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - CIE-10 Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-cie10" aria-expanded="true" aria-controls="collapse-cie10">
          <i class="fas fa-book-medical"></i>
          <span>Catalogo CIE-10</span>
        </a>
        <div id="collapse-cie10" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion de Catalogo CIE-10:</h6>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>cie10Catalog/">Ver Catalogo</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>cie10DataUpdate/">Actualizacion</a>
          </div>
        </div>
      </li>


      <!-- Nav Item - Users Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Usuarios</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion de Usuarios:</h6>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>userList/">Lista de Usuarios</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>activityLogUser/">Registro de Sesiones</a>
          </div>
        </div>
      </li>
<?php endif ?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
