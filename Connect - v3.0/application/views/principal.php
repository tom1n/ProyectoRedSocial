<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	<title>TunFace</title>
</head>
<body class="bg-light">
	<?php if (isset($menu)): ?>
		<?php $this->load->view($menu); ?>
	<?php endif ?>

	<?php if (isset($vista)): ?>
		<div class="container-fluid">
			<?php $this->load->view($vista); ?>	
		</div>
	<?php endif ?>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	
	<?php if (ENVIRONMENT === 'production'): ?>
		<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
	<?php else: ?>	
		<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<?php endif ?>
	
	<?php 
		if (isset($scripts)) {
			foreach ($scripts as $src) {
				echo link_script($src, true);
			}
		}
	?>

</body>
</html>