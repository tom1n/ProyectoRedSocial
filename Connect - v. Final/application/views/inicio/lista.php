<div class="card shadow-sm bg-white mb-3 rounded" v-for="(i,idx) in lista" :key="idx">
  <div class="card-body">
    <div> 
      <img 
        :src="i.registro.foto"
        alt="User"
        class="rounded"
        width="30px"
        height="30px"

      >
      <span class="ml-2"><b>{{ i.registro.propietario }}</b> </span>
      <span class="ml-2 badge badge-light border"><i :class="i.registro.icono"></i> {{i.registro.estado }}</span>

      <!--div class="dropdown mt-1 float-right" v-if="origen === 1">
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
      </div-->


    </div>
    <br>
    <p v-if="i.registro.texto">{{ i.registro.texto }}</p>

    <template v-if="i.imagenes.length > 0">


      <div :id="'galeria_'+idx" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div v-for="(j, idxi) in i.imagenes" class="carousel-item" :class="idxi == 0 ? 'active' : ''">
            <img class="d-block w-100" :src="j.enlace" :alt="j.nombre">
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

    <template v-if="parseInt(i.registro.video) === 1">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe v-if="i.registro.video_enlace.split('youtube').length > 1" class="embed-responsive-item" :src="i.registro.video_enlace"></iframe>
        <video v-else width="100%" controls muted>
          <source :src="i.registro.video_enlace">
        </video>
      </div>
    </template>
    <hr>
    
    <!--button
      v-if="origen === 1"
      class="btn btn-sm btn-light border">
      <i class="far fa-star"></i> {{ i.registro.reaccion }} Reacciones
    </button>
    <span
      v-if="origen === 2"
      class="badge badge-light border">
      <i class="far fa-star"></i> {{ i.registro.reaccion }} Reacciones
    </span-->

    <small class="text-muted float-right">{{ i.registro.fecha_publicacion }}</small>
  </div>
</div>