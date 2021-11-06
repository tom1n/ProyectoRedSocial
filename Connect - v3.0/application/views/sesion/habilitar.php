<div class="row justify-content-center">
	<div class="col-sm-4">
		
		<div class="card mt-5">
			<div class="card-body">
				
				<div class="text-center">
		        	<img height="80px" src="<?php echo base_url('assets/img/logo.png') ?>" alt="Logo">
		        </div>
				<br><br>
				<h1 class="text-center">Hola <?php echo $usuario->nombre; ?></h1>

				<?php if ($usuario->habilitado == 0): ?>
					<p class="text-center">Gracias por formar parte de la familia TunFace, tu cuenta ha sido confirmada.</p>
				<?php else: ?>

					<p class="text-center">Tu cuenta ha sido confirmada el <?php echo date('d/m/Y H:i', strtotime($usuario->habilitado_fecha)) ?></p>
				<?php endif ?>

				<div class="text-center">
					<br><br>
					<a href="<?php echo base_url('usuario') ?>" class="btn btn-primary">Iniciar sesión</a>
				</div>
			</div>
		</div>
	</div>
</div>