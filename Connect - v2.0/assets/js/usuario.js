let appregistro = {
	template: '#app-registro',
	data: () => ({
		form: {},
		mensaje: null,
		btnGuardar: false,
		exito: 0
	}),
	methods: {
		guardar() {
			this.btnGuardar = true

			axios
			.post('index.php/usuario/guardar', this.form)
			.then(res => {
				this.exito = parseInt(res.data.exito)
				this.btnGuardar = false

			}).catch(e => {
				this.mensaje = e.message
				this.btnGuardar = false
			})
		}
	}
}