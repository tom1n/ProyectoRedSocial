var appPerfil = new Vue({
	el: '#appPerfil',
	data: {
		mensaje: null,
		codigo: null,
		cargando: false,
		usuario: {},
		amigos: [],
		lista: [],
		termino: null,
		actual: {},
		origen: 1,
		registro: 0,
		imagenes: [],
		btnImagen: false
	},
	mounted() {
		this.codigo = this.$el.getAttribute('codigo')
		this.buscar()
		this.origen = this.actual.id == this.usuario.id ? 1: 2
	},
	methods: {
		buscar() {
			this.cargando = true

			axios
			.get(`${this.urlBase}/perfil/get_datos/${this.codigo}`)
			.then(res => {

				this.amigos = res.data.amigos
				this.usuario = res.data.usuario
				this.lista = res.data.publicacion
				this.actual = res.data.actual

				this.cargando = false
			}).catch(e => {

				this.cargando = false
				alert(e.message)
			})
		},
		setActualizacion(valor) {
			for (let i in valor) {
				this.usuario[i] = valor[i]
			}
		},
		cancelar() {
			this.imagenes = []
			document.getElementById('inputImagen').value = ''
		},
		setImagenes (e) {
			this.imagenes = []

			let imgs = e.target.files
			
			for (var i = imgs.length - 1; i >= 0; i--) {
				this.imagenes.push(URL.createObjectURL(imgs[i]))
			}
		},
		guardarFoto(e) {
			if (confirm('¿Está seguro?')) {
				this.mensaje = null;

				if (this.imagenes.length == 0) {
					this.mensaje = 'Seleccione una imagen'
					return false

				} else {

					this.btnImagen = true
					let datos = new FormData(e.target)
					datos.append('usuario_id', this.usuario.id)

					axios
					.post(`${this.urlBase}/usuario/guardar_imagen`, datos)
					.then(res => {
						if (res.data.exito) {
							this.usuario.foto = res.data.foto
							e.target.reset()
							this.imagenes = []
							window.location.reload()
						} else {
							this.mensaje = res.data.mensaje
						}

						this.btnImagen = false
					}).catch(e => {
						this.mensaje = e.message
						this.btnImagen = false
					})
				}
			}
		}
	},
	computed: {
		getAmigos() {
			if (this.termino) {
				return this.amigos.filter(e => {
					return e.nombre.toLowerCase().includes(this.termino.toLowerCase())
				})
			} else {
				return this.amigos
			}
		}
	},
	components: {
		appregistro
	}
})