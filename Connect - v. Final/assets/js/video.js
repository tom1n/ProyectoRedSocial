let apppublicarvideo = {
	props: {
		nivel: {
			type: Array,
			required: true
		}
	},
	template: '#app-publicar-video',
	data: () => ({
		form: {
			nivel_id: 3,
			video_enlace: null
		},
		enlace: false,
		mensaje: null,
		btnGuardar: false
	}),
	methods: {
		getNivel(valor) {
			return this.nivel.filter(e => {
				return parseInt(e.id) === parseInt(valor)
			})[0]
		},
		cancelar() {
			let vid = document.getElementById('inputVideo')
			if (vid) {
				vid.value = ''
			}

			let enl = document.getElementById('inputEnlace')
			if (enl) {
				enl.value = ''
			}
		},
		guardar(e) {
			this.mensaje = null;

			this.btnGuardar = true
			let datos = new FormData(e.target)
			datos.append('nivel_id', this.form.nivel_id)

			axios
			.post(`${this.urlBase}/publicacion/guardar_video`, datos)
			.then(res => {
				if (res.data.exito) {
					this.$emit('set-registro', res.data.linea)
					this.form.nivel_id = 3
					e.target.reset()
					this.enlace = false
				} else {
					this.mensaje = res.data.mensaje
				}

				this.btnGuardar = false
			}).catch(e => {
				this.mensaje = e.message
				this.btnGuardar = false
			})
		}
	},
	computed: {
		visor() {
			return this.getNivel(this.form.nivel_id)
		}
	},
	watch: {
		enlace () {
			this.cancelar()
		}
	}
}