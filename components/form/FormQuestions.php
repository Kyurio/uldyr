<form @submit.prevent="PostCreateData" method="post" enctype="multipart/form-data" novalidate="true">
    <div class="mb-2">
        <label for="exampleFormControlTextarea1" class="form-label">Preguntas</label>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
            v-model="formData.pregunta">
    </div>
    <div class="mb-2">
        <label for="exampleFormControlTextarea1" class="form-label">Responder:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
            v-model="formData.respuesta"></textarea>
    </div>

    <button class="btn btn-dark btn-sm">Guardar</button>

</form>