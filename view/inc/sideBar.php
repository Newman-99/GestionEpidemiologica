
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

      <!-- Nav Item - Casos epidemis Collapse Menu -->
      <?php if ($_SESSION['id_nivel_permiso'] == "1" || $_SESSION['id_nivel_permiso'] == "2" ): ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecasosEpidemi" aria-expanded="true" aria-controls="collapsecasosEpidemi">
          <i class="fas fa-file-medical"></i>
          <span>Casos Epidemilogicos</span>
        </a>
        <div id="collapsecasosEpidemi" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <?php if ($_SESSION['id_nivel_permiso'] < 3): ?>

            <a class="collapse-item" href="<?php echo SERVERURL; ?>casosEpidemiList/">Lista de Casos</a>
          <?php endif; ?>

            <a class="collapse-item" href="<?php echo SERVERURL; ?>reportEPI/">Reportes EPI</a>

            <?php if ($_SESSION['id_nivel_permiso'] == 1): ?>

            <a class="collapse-item" href="<?php echo SERVERURL; ?>activityLogCasosEpidemi/">Registro de Operaciones</a>
          <?php endif; ?>

          </div>
        </div>
      </li>
<?php endif ?>

      <!-- Nav Item - CIE-10 Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-cie10" aria-expanded="true" aria-controls="collapse-cie10">
          <i class="fas fa-book-medical"></i>
          <span>Catalogo CIE-10</span>
        </a>
        <div id="collapse-cie10" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>cie10Catalog/">Ver Catalogo</a>
            <?php if ($_SESSION['id_nivel_permiso'] == "1"): ?>

            <span class="collapse-item">
              <button type="button" id="importCIE10Modal" class="importCIE10Modal" data-toggle="modal" data-target="#importCIE10Modal" style="
              padding: 0;
              border: none;
              background: none;">
                Importar
              </button>
          </span>

          <?php endif ?>

          </div>
        </div>
      </li>


      <?php if ($_SESSION['id_nivel_permiso'] == "1"): ?>
      <!-- Nav Item - Users Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Usuarios</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo SERVERURL; ?>userList/">Lista de Usuarios</a>
            <a class="collapse-item" href="<?php echo SERVERURL; ?>activityLogSessions/">Registro de Sesiones</a>
          </div>
        </div>
      </li>
<?php endif; ?>


      <?php if ($_SESSION['id_nivel_permiso'] == "1"): ?>
      <!-- Nav Item - Users Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true" aria-controls="collapseSystem">
          <i class="fas fa-fw fa-cog"></i>
          <span>Sistema</span>
        </a>
        <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
      
      <span class="collapse-item">
          <button type="button" class="backupModal" data-toggle="modal" data-target="#backupModal" style="
          padding: 0;
          border: none;
          background: none;">
            Respaldo
          </button>
      </span>


      <span class="collapse-item">
          <button type="button" class="restoreModal" data-toggle="modal" data-target="#restoreModal" style="
          padding: 0;
          border: none;
          background: none;">
            Restauracion
          </button>
      </span>

          </div>
        </div>
      </li>
<?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
