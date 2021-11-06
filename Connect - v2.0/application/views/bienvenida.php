<h1 class="text-center mt-5">
	Hola 
	<?php echo $this->session->userdata('usuario')['nombre'] ?>
</h1>


<div class="text-center mt-5">
	<a href="./usuario/cerrar" class="btn btn-danger">Cerrar sesión</a>
</div>