<div id="appPerfil" codigo="<?php echo $user ?>">
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
      <div class="row mt-4">
        <div class="col-sm-4">
          <div class="card shadow-sm mb-3 bg-white rounded">
            <div class="card-body text-center">
              <img 
                :src="usuario.foto"
                alt="User"
                class="rounded-circle"
                width="150px"
                height="150px"
              >
              <h4 class="mt-3">{{ usuario.nombre }}</h4>
              <small class="text-muted">{{ usuario.alias }}</small>
              <br><br>
              <div class="text-center" v-if="usuario.id == actual.id">
                <button
                  type="button"
                  @click="registro = 1"
                  class="btn btn-sm btn-primary"
                  data-toggle="modal"
                  data-target="#mdlCuenta">
                  <i class="fa fa-user"></i> Editar perfil
                </button>
                <button type="button" class="btn btn-sm btn-info border" data-toggle="modal"
                  data-target="#mdlFoto">
                  <i class="fa fa-images"></i> Cambiar foto
                </button>
              </div>
            </div>
          </div>

          <div class="card shadow-sm bg-white rounded">
            <div class="card-body">
              <p><i class="fa fa-users"></i> Amigos</p>
              <input
                type="search"
                class="form-control form-control-sm"
                placeholder="Nombre..."
                v-model="termino"
              >
              <br>
              <table>
                <tr v-for="i in getAmigos">
                  <td width="30%" class="p-1">
                    <img 
                      :src="i.foto"
                      alt="User"
                      class="rounded"
                      width="40px"
                      height="40px"
                    >
                  </td>
                  <td width="60%" class="p-1">
                    <b><a :href="`/red/perfil/usuario/${i.codigo}`" class="text-dark text-decoration-none">{{ i.nombre }}</a></b><br>
                    <small class="text-muted">{{ i.alias }}</small>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <?php $this->load->view('inicio/lista'); ?>
        </div>
      </div>
    </template>

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
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar datos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="registro = 0">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <AppRegistro
              v-if="registro == 1"
              :editar="1"
              :usuario="usuario"
              @actualizar="setActualizacion"
            />
          </div>
        </div>
      </div>
    </div>


    <div
      class="modal fade"
      id="mdlFoto"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar foto de perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" @submit.prevent="guardarFoto">
              <div class="form-row mb-3">
                <div class="col-sm-12">
                  <input
                    type="file"
                    accept="image/*"
                    @change="setImagenes"
                    id="inputImagen"
                    name="foto"
                    :required="true"
                  >
                </div>
              </div>
              
              <div class="form-row mb-3">
                <div class="col-sm-12" v-if="imagenes.length > 0">
                  <div class="row justify-content-center">
                    <div class="col-sm-4 mb-2" v-for="i in imagenes">
                      <img  :src="i" alt="img" width="200px" height="200px" class="rounded-circle"> 
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-row mb-3">
                <div class="col-sm-12 text-right">
                  <button
                    type="button"
                    class="btn btn-default border"
                    v-if="imagenes.length > 0"
                    title="Cancelar"
                    @click="cancelar"
                    :disabled="btnImagen"
                  >
                    <i class="fa fa-times"></i> Cancelar
                  </button>
                  <button class="btn btn-sm btn-primary" :disabled="btnImagen">
                    {{ btnImagen ? 'Espere...' : 'Actualizar' }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>

<?php $this->load->view('mnt/usuario/form_registro'); ?>