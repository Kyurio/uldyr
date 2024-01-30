<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pregunta</th>
            <th scope="col">Accion</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item, index) in paginatedPreguntas" :key="index">
            <th scope="row">{{index}}</th>
            <td>{{ item.pregunta }}</td>
            <td>
                <button class="btn btn-sm btn-dark me-1" @click="DeletePregunta(item.id_pregunta)"><i class="fa-solid fa-trash"></i></button>
                <button class="btn btn-sm btn-dark" @click="SeleccionarPregunta(item.pregunta)" ><i class="fa-solid fa-check"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<div class="pagination">
    <button :disabled="currentPage === 1" @click="prevPage">Anterior</button>
    <span>{{ currentPage }}</span>
    <button :disabled="currentPage === totalPages" @click="nextPage">Siguiente</button>
</div>