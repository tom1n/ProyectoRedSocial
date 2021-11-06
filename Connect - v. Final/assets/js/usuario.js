let appregistro = {
	props: {
		editar: {
			type: Number,
			required: false,
			default: 0
		},
		usuario: {
			type: Object,
			required: false,
			default: {}
		}
	},
	template: '#app-registro',
	data: () => ({
		form: {},
		mensaje: null,
		btnGuardar: false,
		exito: 0,
		reg: ''
	}),
	created() {
		this.setDatos()
	},
	methods: {
		guardar() {
			this.btnGuardar = true
			this.mensaje = null

			axios
			.post(`${this.urlBase}/usuario/guardar/${this.reg}`, this.form)
			.then(res => {
				this.exito = parseInt(res.data.exito)
				this.mensaje = res.data.mensaje
				this.btnGuardar = false

				if (this.editar == 1) {
					this.$emit('actualizar', this.form)
				}
			}).catch(e => {
				this.mensaje = e.message
				this.btnGuardar = false
			})
		},
		setDatos() {
			if (this.editar == 1) {
				for (let i in this.usuario) {
					if (i !== 'clave') {
						this.form[i] = this.usuario[i]
					}
				}

				this.reg = this.usuario.id
			} else {
				this.reg = ''
				this.form = {}
			}
		}
	}
}