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
          <span class="ml-2"><b>{{ i.registro.propietario }}</b> </span>
          <span class="ml-2 badge badge-light border"><i :class="i.icono"></i> {{i.registro.estado }}</span>

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
        <p v-if="i.registro.texto">{{ i.registro.texto }}</p>

        <template v-if="i.imagenes.length > 0">


          <div :id="'galeria_'+idx" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div v-for="(j, idxi) in i.imagenes" class="carousel-item" :class="idxi == 0 ? 'active' : ''">
                <img class="d-block w-100" :src="j.enlace" alt="j.nombre">
              </div>
            </div>
            <a class="carousel-control-prev" :href="'#galeria_'+idx" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" :href="'#galeria_'+idx" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </template>

        <hr>
        
        <button
          v-if="origen === 1"
          class="btn btn-sm btn-light border">
          <i class="far fa-star"></i> {{ i.registro.reaccion }} Reacciones
        </button>
        <span
          v-if="origen === 2"
          class="badge badge-light border">
          <i class="far fa-star"></i> {{ i.registro.reaccion }} Reacciones
        </span>

        <small class="text-muted float-right">{{ i.registro.fecha_publicacion }}</small>
      </div>
    </div>
  </div>
</div>