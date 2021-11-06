<div class="row d-flex justify-content-center mt-5" id="appSesion">
  <div class="col-sm-4">
    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
      <div class="card-body">
        <div class="text-center">
          <img src="assets/img/logo.png" alt="Logo">
        </div>
        <br>
        <p class="text-muted text-center">Ingresa el usuario y la contraseña para acceder.</p>
        <br><br>
        <form @submit.prevent="iniciar">
          <div class="alert alert-danger" v-if="mensaje !== null"> {{ mensaje }}</div>

          <div class="form-row mb-3">
            <div class="col-sm-12">
              <label for="usuario" class="control-label mb-0">Usuario:</label>
              <input type="text" class="form-control" placeholder="Escriba su nombre de usuario o correo electrónico" v-model="form.usuario">
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="col-sm-12">
              <label for="contrasenia" class="control-label mb-0">Contraseña:</label>
              <input type="password" class="form-control" v-model="form.clave" placeholder="Escriba la constraseña registrada">
            </div>
          </div>

          <div class="form-row">
            <div class="col-sm-12 text-end">
              <button class="btn btn-primary btn-block" :disabled="btnLogin">
                {{ btnLogin ? 'Ingresando...' : 'Ingresar' }}
              </button>

              <p class="text-center mt-4 mb-0">
                <a href="">¿Olvidaste tu contraseña?</a> <br>
              </p>

              <div class="text-center mt-3">
                <button
                  type="button"
                  class="btn btn-success"
                  @click="registro = 1"
                  data-toggle="modal"
                  data-target="#mdlCuenta">
                  Crear una nueva cuenta
                </button>
              </div>
            </div>
          </div>
        </form>


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
                <h5 class="modal-title" id="staticBackdropLabel">Registro</h5>
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


        

      </div>
    </div>
  </div>
</div>

<?php $this->load->view('mnt/usuario/form_registro'); ?>