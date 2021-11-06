let apppublicarimagen = {
	props: {
		nivel: {
			type: Array,
			required: true
		}
	},
	template: '#app-publicar-imagen',
	data: () => ({
		form: {
			nivel_id: 3
		},
		mensaje: null,
		imagenes: [],
		btnGuardar: false
	}),
	methods: {
		getNivel(valor) {
			return this.nivel.filter(e => {
				return parseInt(e.id) === parseInt(valor)
			})[0]
		},
		setImagenes(e) {
			this.imagenes = []

			let imgs = e.target.files
			
			for (var i = imgs.length - 1; i >= 0; i--) {
				this.imagenes.push(URL.createObjectURL(imgs[i]))
			}
		},
		cancelar() {
			this.imagenes = []
			document.getElementById('inputImagen').value = ''
		},
		guardar(e) {
			this.mensaje = null;

			if (this.imagenes.length == 0) {
				this.mensaje = 'Seleccione una o varias imágenes'
				return false

			} else {

				this.btnGuardar = true
				let datos = new FormData(e.target)
				datos.append('nivel_id', this.form.nivel_id)

				axios
				.post('index.php/publicacion/guardar_imagen', datos)
				.then(res => {
					if (res.data.exito) {
						this.$emit('set-registro', res.data.linea)
						this.form.nivel_id = 3
						e.target.reset()
						this.imagenes = []
					} else {
						this.mensaje = res.data.mensaje
					}

					this.btnGuardar = false
				}).catch(e => {
					this.mensaje = e.message
					this.btnGuardar = false
				})
			}
		}
	},
	computed: {
		visor() {
			return this.getNivel(this.form.nivel_id)
		}
	}
}