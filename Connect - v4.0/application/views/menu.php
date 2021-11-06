<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background:#175287!important;">
  <a class="navbar-brand" href="#">
    <img
      src="<?php echo base_url('assets/img/logo.png') ?>"
      alt="Logo"
      width="100"
      height="30">
  </a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <?php if ($this->session->userdata('usuario')): ?>
        <li class="nav-item <?php echo $opcion == 1 ? 'active': '';?> ">
          <a class="nav-link" href="#"><i class="fa fa-home fa-fw"></i> Inicio</a>
        </li>
        <li class="nav-item <?php echo $opcion == 2 ? 'active': '';?> ">
          <a class="nav-link" href="#"><i class="fa fa-users fa-fw"></i> Amigos</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="javascript:;"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <?php echo $this->session->userdata('usuario')['nombre'] ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"><i class="fa fa-user fa-fw"></i>  Perfil</a>
            <a class="dropdown-item" href="<?php echo base_url("usuario/cerrar") ?>"><i class="fa fa-sign-out-alt fa-fw"></i>  Cerrar sesión</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="btn btn-sm btn-primary mr-1" href="usuario">
            <i class="fa fa-sign-in-alt"></i> Iniciar sesión
          </a>
        </li>
        <li class="nav-item">
          <button
            type="button"
            class="btn btn-sm btn-success"
            @click="registro = 1"
            data-toggle="modal"
            data-target="#mdlCuenta">
            <i class="fa fa-plus"></i> Crear cuenta
          </button>
        </li>
      <?php endif ?>
    </ul>
  </div>
</nav>