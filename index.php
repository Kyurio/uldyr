<?php
    include 'components/inc/header.php';
?>

<body>
  <main>
    <div id="app">
      <div class="container">


        <?php include 'components/section/admin.php' ?>

        <section>
          <div class="asistente-virtual">
            <div class="chat-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
              aria-controls="offcanvasRight">
              <img src="assets/img/vikingo.png" width="35" height="35" alt="uldyr">
            </div>

          </div>
        </section>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Hola!, Bienvenido a <?=TITTLE?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-flex flex-column">
          
            <div class="flex-grow-1">
              <div>
                <div class="alert alert-primary text-rigth" role="alert" v-if="Respuestas.respuesta">
                  <span>uldyr:</span>
                  <p v-html="Respuestas.respuesta"></p>
                </div>
              </div>
            </div>
            <div>
              <section v-if="FlagClient == true">
                <form @submit.prevent="PostCliente" method="post" novalidate="true">
                  <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" aria-describedby="Email"
                      v-model="formClientes.Email">
                  </div>
                  <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="Nombre" aria-describedby="Nombre"
                      v-model="formClientes.Nombre">
                  </div>
                  <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                </form>
              </section>
              <section v-else>
                <form @submit.prevent="GetPreguntas" method="post" novalidate="true">
                  <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea" v-model="formPreguntas.pregunta"></textarea>
                    <label for="floatingTextarea">¿Cómo te puedo ayudar?</label>
                  </div>
                  <button type="submit" class="btn btn-primary mt-2"> Enviar</button>
                </form>
              </section>
            </div>

          </div>
        </div>

      </div>
    </div>
  </main>
  <?php include 'components/inc/footer.php' ?>
</body>

</html>