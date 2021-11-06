<template id="app-publicar-video">
  <div>
    <div class="alert alert-danger" v-if="mensaje !== null">{{ mensaje }}</div>
    <form @submit.prevent="guardar" autocomplete="off" id="formImagen">
      <div class="form-row mb-3">
        <div class="col-sm-12">
          <input
            type="text"
            class="form-control rounded-0"
            placeholder="Escribe lo que piensas."
            name="texto"
          >
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col-sm-12">
          <div class="custom-control custom-checkbox">
            <input
              type="checkbox"
              class="custom-control-input"
              id="checkboxVideo"
              v-model="enlace"
            >
            <label class="custom-control-label" for="checkboxVideo">Agregar enlace del video</label>
          </div>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col-sm-8" v-if="enlace === false">
          <input
            type="file"
            accept="video/*"
            id="inputVideo"
            name="video"
          >
        </div>
        <div class="col-sm-8"v-if="enlace === true">
          <input
            type="text"
            id="inputEnlace"
            name="video_enlace"
            class="form-control"
            placeholder="Pegue el enlace del video"
          >
          <small class="text-muted">
            Si el video es de Youtube, copie el enlace de inserción y peguelo.
          </small>
        </div>

        <div class="col-sm-4">
          <div class="dropdown text-right" v-if="visor">
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

            <div 
              class="dropdown-menu dropdown-menu-right dropdown-menu-sm" 
              aria-labelledby="dropdownMenuButton"
            >
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
      </div>

      <div class="form-row">
        <div class="col-sm-12 text-right">
          <!--button
            type="button"
            class="btn btn-default border"
            v-if="imagenes.length > 0"
            title="Cancelar"
            @click="cancelar"
            :disabled="btnGuardar"
          >
            <i class="fa fa-times"></i> Cancelar
          </button-->
          <button
            type="submit"
            class="btn btn-primary"
            title="Publicar"
            :disabled="btnGuardar"
          >
            <i class="fa fa-upload fa-fw"></i> {{ btnGuardar ? 'Publicando...' : 'Publicar' }}
        </div>
      </div>

      
      
    </form>
  </div>
</template>