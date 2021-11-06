<div id="appPublicacion" origen="<?php echo $origen; ?>">
  <?php $this->load->view('menu'); ?>

  <div class="container">
    <div class="d-flex justify-content-center mt-5" v-if="cargando === true">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <p class="text-center" v-if="cargando === true">
      <small>Espere mientras se carga el contenido...</small>
    </p>
    <template v-if="cargando === false">
      <div class="row justify-content-center" v-if="origen === 1">
        <div class="col-sm-8 mt-4">
          <?php $this->load->view('inicio/form'); ?>
        </div>
      </div>

      <div class="row justify-content-center mt-3">
        <div class="col-sm-8">
          <?php $this->load->view('inicio/lista'); ?>
        </div>
      </div>

      <div
        class="modal fade"
        id="mdlCuenta"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Nueva cuenta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="registro = 0">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <AppRegistro v-if="registro == 1"/>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="mdlPublicarImagen"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                <span class="text-success">
                  <i class="fa fa-images fa-fw"></i>
                </span> Publicar imágenes
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="imagen = false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <AppPublicarImagen 
                v-if="imagen === true"
                :nivel="nivel"
                @set-registro="setRegistro"
              />
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="mdlPublicarVideos"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                <span class="text-danger">
                  <i class="fa fa-video fa-fw"></i>
                </span> Publicar videos
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="imagen = false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <AppPublicarVideo 
                v-if="video === true"
                :nivel="nivel"
                @set-registro="setRegistro"
              />
            </div>
          </div>
        </div>
      </div>

    </template>
  </div>
</div>

<?php $this->load->view('mnt/usuario/form_registro'); ?>
<?php $this->load->view('inicio/form_imagen'); ?>
<?php $this->load->view('inicio/form_video'); ?>