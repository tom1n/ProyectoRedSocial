var appPublicacion = new Vue({
	el: '#appPublicacion',
	data: {
		form: {
			nivel_id: 3,
			texto: null
		},
		registro: 0,
		btnGuardar: false,
		mensaje: null,
		cargando: false,
		lista: [],
		nivel: [],
		origen: 1,
		imagen: false,
		video: false
	},
	mounted() {
		this.origen = parseInt(this.$el.getAttribute('origen'))
		this.buscar()
	},
	methods: {
		buscar() {
			this.cargando = true

			axios
			.get('index.php/inicio/buscar', {params:{origen:this.origen}})
			.then(res => {
				this.cargando = false

				this.lista = res.data.lista
				this.nivel = res.data.nivel

			}).catch(e => {
				alert(e.message)
				this.cargando = false
			})
		},
		guardar() {
			if (this.form.texto) {
				this.mensaje = null
				this.btnGuardar = true

				axios
				.post('index.php/publicacion/guardar', this.form)
				.then(res => {
					if (res.data.exito) {
						this.setRegistro(res.data.linea)
						this.form = {
							nivel_id: 3,
							texto: null
						}
					} else {
						this.mensaje = res.data.mensaje
					}

					this.btnGuardar = false
				}).catch(e => {
					this.mensaje = e.message
					this.btnGuardar = false
				})

			} else {
				this.mensaje = 'Escribe lo que piensas.'
			}
		},
		getNivel(valor) {
			return this.nivel.filter(e => {
				return parseInt(e.id) === parseInt(valor)
			})[0]
		},
		setRegistro(valor) {
			this.lista = [valor, ...this.lista]
		}
	},
	computed: {
		visor() {
			return this.getNivel(this.form.nivel_id);
		}
	},
	components: {
		appregistro,
		apppublicarimagen
	}
})