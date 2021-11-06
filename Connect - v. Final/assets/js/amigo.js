var appAmigo = new Vue({
	el: '#appAmigos',
	data: {
		user: {},
		amigos: [],
		cargando: false,
		termino: null,
		lista: []
	},
	created() {
		this.getDatos()
	},
	methods: {
		getDatos() {
			this.cargando = true

			axios
			.get(`${this.urlBase}/amigos/get_datos`)
			.then(res => {
				this.cargando = false

				this.user = res.data.usuario
				this.amigos = res.data.amigos

			}).catch(e => {
				alert(e.message)
				this.cargando = false
			})
		},
		buscar() {

			axios
			.get(`${this.urlBase}/amigos/buscar`, {params: {termino:this.termino}})
			.then(res => {
				this.lista = res.data.lista

			}).catch(e => {
				alert(e.message)
			})
		},
		accion (obj, valor) {
			if (confirm('¿Seguro?')) {

				let data = {
					valor: valor,
					amigo: obj.id
				}

				let reg = ''
				if (obj.agregado_id) {
					reg = parseInt(obj.agregado_id)
				}


				axios
				.post(`${this.urlBase}/amigos/accion/${reg}`, data)
				.then(res => {
					if (res.data.exito) {
						

						if (valor == 1) {
							this.amigos.push(res.data.amigo)
							obj.agregado_id = res.data.reg
							obj.agregado = 1
						} else {
							let tmpKey = this.amigos.filter(e => {
								return e.id == res.data.reg
							})[0]

							let key = this.amigos.indexOf(tmpKey)

							this.amigos.splice(key, 1)
							obj.agregado_id = null
							obj.agregado = 0
						}

					} else {
						alert(res.data.mensaje)
					}
				}).catch(e => {
					alert(e.message)
				})
			}
		}
	}
})