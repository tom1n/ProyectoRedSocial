<template id="app-registro">
	<div>
		<div class="alert alert-success text-center mb-0" v-if="exito === 1">
			Hemos enviado a tu correo electrónico un enlace para confirmar tu identidad.
		</div>
		<form @submit.prevent="guardar" v-if="exito === 0">
			<div class="alert alert-danger text-center mb-0" v-if="mensaje !== null">
				{{ mensaje }}
			</div>

			<div class="form-row mb-2">
				<div class="col-sm-12">
					<input
						type="text"
						class="form-control"
						v-model="form.nombre"
						placeholder="Nombre completo"
						:required="true"
					>
				</div>
			</div>

			<div class="form-row mb-2">
				<div class="col-sm-12">
					<input
						type="mail"
						class="form-control"
						v-model="form.correo"
						placeholder="Correo electrónico"
						:required="true"
					>
				</div>
			</div>


			<div class="form-row mb-2">
				<div class="col-sm-12">
					<input
						type="text"
						class="form-control"
						v-model="form.alias"
						placeholder="Nombre de usuario, alias o seudónimo"
						:required="true"
					>
				</div>
			</div>


			<div class="form-row mb-2">
				<div class="col-sm-12">
					<input
						type="password"
						class="form-control"
						v-model="form.clave"
						placeholder="Contraseña"
						:required="true"
					>
				</div>
			</div>

			<div class="form-row mb-2">
				<div class="col-sm-6">
					<input
						type="date"
						class="form-control"
						v-model="form.fecha_nacimiento"
						placeholder="Fecha de nacimiento"
						title="Fecha de nacimiento"
						:required="true"
					>
				</div>

				<div class="col-sm-6">
					<input
						type="number"
						class="form-control"
						v-model="form.edad"
						placeholder="Edad"
						:required="true"
					>
				</div>
			</div>

			<div class="form-row mb-0">
				<div class="col-sm-12 text-right">
					<button class="btn btn-success" :disabled="btnGuardar">
						{{ btnGuardar ? 'Espere por favor...' : 'Registrarme' }}
					</button>
				</div>
			</div>

		</form>
	</div>
</template>