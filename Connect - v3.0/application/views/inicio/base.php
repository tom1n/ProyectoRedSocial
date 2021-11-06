<div class="container" id="appPublicacion" origen="<?php echo $origen; ?>">
  <div class="d-flex justify-content-center mt-5" v-if="cargando === true">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <template v-if="cargando === false">
    <div class="row justify-content-center" v-if="origen === 1">
      <div class="col-sm-8 mt-5">
        <div class="card shadow-sm bg-white rounded">
          <div class="card-body">
            <p v-if="mensaje !== null" class="alert alert-danger p-1 text-center"><i class="fa fa-exclamation-triangle"></i> {{ mensaje}}</p>

            <form @submit.prevent="guardar" autocomplete="off">
              <div class="row">
                <div class="col-sm-1 text-center">
                  <img 
                    src="https://scontent.fgua9-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?_nc_cat=1&ccb=1-5&_nc_sid=7206a8&_nc_ohc=VmoUYsvkMUAAX_Td7iX&_nc_ht=scontent.fgua9-1.fna&oh=2af7f576e73fbbc491285da14072ed9d&oe=61920478"
                    alt="User"
                    class="rounded"
                    width="50px"
                  >
                </div>
                <div class="col-sm-11 mb-3">
                  <input
                    type="text"
                    class="form-control rounded-0"
                    placeholder="Escribe lo que piensas."
                    v-model="form.texto"
                  >
                  <div class="dropdown mt-1" v-if="visor">
                    <button
                      class="btn btn-sm btn-light py-0 px-3 border dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i :class="visor.icono"></i> {{ visor.nombre }}
                    </button>

                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                      <a 
                        v-for="i in nivel" 
                        class="dropdown-item" 
                        href="#" 
                        @click.prevent="form.nivel_id = i.id"
                      >
                        <i :class="i.icono" class="fa-fw"></i> {{ i.nombre }}
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 m-0 text-right">
                  <button
                    type="button"
                    class="btn btn-light border"
                    title="Agregar videos"
                    :disabled="btnGuardar"
                  >
                    <span class="text-danger">
                      <i class="fa fa-video fa-fw"></i>
                    </span> Videos
                  </button>
                  <button
                    type="button"
                    class="btn btn-light border"
                    title="Agregar imagenes"
                    :disabled="btnGuardar"
                  >
                    <span class="text-success">
                      <i class="fa fa-images fa-fw"></i>
                    </span> Imagenes
                  </button>
                  <button
                    type="submit"
                    class="btn btn-primary"
                    title="Publicar"
                    :disabled="btnGuardar"
                  >
                    <i class="fa fa-upload fa-fw"></i> {{ btnGuardar ? 'Publicando...' : 'Publicar' }}
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>


    <div class="row justify-content-center" v-for="(i,idx) in lista" :key="idx">
      <div class="col-sm-8 mt-3">
        <div class="card shadow-sm bg-white rounded">
          <div class="card-body">
            <div> 
              <img 
                src="https://scontent.fgua9-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?_nc_cat=1&ccb=1-5&_nc_sid=7206a8&_nc_ohc=VmoUYsvkMUAAX_Td7iX&_nc_ht=scontent.fgua9-1.fna&oh=2af7f576e73fbbc491285da14072ed9d&oe=61920478"
                alt="User"
                class="rounded"
                width="30px"
              >
              <span class="ml-2"><b>{{ i.propietario }}</b> </span>
              <span class="ml-2 badge badge-light border"><i :class="i.icono"></i> {{i.estado }}</span>

              <div class="dropdown mt-1 float-right" v-if="origen === 1">
                <a
                  class="text-muted py-0 px-3 dropdown-toggle"
                  type="button"
                  id="dropdownMenuButton"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="true"
                >
                  <i class="fa fa-cog"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                  <a
                    class="dropdown-item" 
                    href="#"
                  >
                    <i class="fa fa-trash" class="fa-fw"></i> Eliminar publicación
                  </a>
                </div>
              </div>


            </div>
            <br>
            <p>{{ i.texto }}</p>
            <hr>
            <button href="#" class="btn btn-sm btn-light border"><i class="far fa-star"></i> {{ i.reaccion }} Reacciones</button>
            <small class="text-muted float-right">{{ i.fecha_publicacion }}</small>
          </div>
        </div>
      </div>
    </div>

  </template>
</div>