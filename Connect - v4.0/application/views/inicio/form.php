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
            @click="video = true"
            title="Agregar videos"
            :disabled="btnGuardar"
            data-toggle="modal"
            data-target="#mdlPublicarVideos"
          >
            <span class="text-danger">
              <i class="fa fa-video fa-fw"></i>
            </span> Videos
          </button>
          <button
            type="button"
            class="btn btn-light border"
            @click="imagen = true"
            title="Agregar imagenes"
            :disabled="btnGuardar"
            data-toggle="modal"
            data-target="#mdlPublicarImagen"
          >
            <span class="text-success">
              <i class="fa fa-images fa-fw"></i>
            </span> Imágenes
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