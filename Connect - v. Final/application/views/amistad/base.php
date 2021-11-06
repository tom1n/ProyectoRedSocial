<div class="container mt-3" id="appAmigos">
  <h4 class="font-weight-400 mb-4">
    <i class="text-info fa fa-users"></i> Busca a las personas que quisieras conocer
  </h4>

  <div class="row mt-3">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <i class="font-weight-400 text-muted mb-4">Mis amigos</i>
          <br><br>

          <table style="width:100%">
            <tr v-for="i in amigos">
              <td style="width: 12%" class="p-1">
                <img 
                  :src="i.foto"
                  alt="User"
                  class="rounded"
                  width="40px"
                >
              </td>
              <td style="width: 88%" class="text-left p-1">
                <button
                  title="Eliminar de mis amigos"
                  class="close"
                  @click="accion({id:i.amigo, agregado_id: i.id}, 0)"
                >&times;</button>
                <b>
                  <a 
                    :href="`/red/perfil/usuario/${i.codigo}`"
                    class="text-dark text-decoration-none"
                  >{{ i.nombre }}</a>
                </b><br>
                <small class="text-muted">{{ i.alias }}</small>
              </td>
            </tr>
          </table>


       
        </div>
      </div>
    </div>

    <div class="col-sm-8">

      

      <input
        type="search"
        class="form-control"
        placeholder="Escribe el nombre o usuario"
        v-model="termino"
        @keyup="buscar"
      >

      <div class="row mt-3">
        <div class="col-sm-4 mb-3" v-for="i in lista">
          <div class="card">
            <img
              class="card-img-top"
              :src="i.foto"
              alt="Card image cap"
            >
            <div class="card-body text-center">
              <h5 class="card-title">
                <a
                  :href="`perfil/usuario/${i.codigo}`"
                  class="text-dark text-decoration-none"
                >{{ i.nombre }}</a>
              </h5>
              <button
                class="btn btn-primary"
                v-if="i.agregado == 0"
                @click="accion(i, 1)"
              >
                <i class="fa fa-plus"></i> Agregar
              </button>
              <button
                class="btn btn-light border"
                v-if="i.agregado == 1"
                @click="accion(i, 0)"
              >
                <i class="fa fa-times"></i> Eliminar
              </button>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>