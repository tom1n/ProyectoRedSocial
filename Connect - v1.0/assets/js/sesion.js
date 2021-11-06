var appSesion = new Vue({
	el: '#appSesion',
	data: {
		mensaje: null,
		registro: 0,
		form: {},
		btnLogin: false
	},
	methods: {
		iniciar() {
			this.btnLogin = true
			this.mensaje  = null

			axios
			.post('index.php/usuario/iniciar', this.form)
			.then(res => {
				if (res.data.exito) {
					window.location.href = 'index.php/principal'
				} else {
					this.mensaje = res.data.mensaje;
				}

				this.btnLogin = false

			}).catch(e => {
				this.mensaje = e.message
				this.btnLogin = false
			})
		}
	},
	components: {
		appregistro
	}
})