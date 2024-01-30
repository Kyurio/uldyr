const app = Vue.createApp({
    data() {

        return {

            formPreguntas: {
                pregunta: null,
            },

            formClientes: {
                Email: null,
                Nombre: null,
            },

            formData: {
                pregunta: null,
                respuesta: null, 
            },

            Respuestas: [],
            Preguntas: [],

            FlagClient: true,

            //paginador
            currentPage: 1,
            itemsPerPage: 5,

            //sweet alert
            Toast: Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
            }),


        }

    },

    computed: {

        totalPages() {
            return Math.ceil(this.Preguntas.length / this.itemsPerPage);
        },
        paginatedPreguntas() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.Preguntas.slice(start, end);
        },
    },

    mounted() {

        this.GetAllPreguntas();
    },

    methods: {

        /**
         * 
         *  funciones get
         * 
         */

        async GetPreguntas() {
            try {
                const response = await axios.post('app/controller/data/GetPreguntas', this.formPreguntas);

                console.log(response.data);
                this.Respuestas = response.data;
                this.PostPregunta();
                this.formPreguntas.pregunta = '';

            } catch (error) {
                console.error('Error al obtener preguntas:', error);
            }
        },

        async GetAllPreguntas() {
            try {
                console.log("sadjbasjdbkas");
                const response = await axios.get('app/controller/questions/GetAllPreguntas');

                console.log(response.data);
                this.Preguntas = response.data;

            } catch (error) {
                console.error('Error al obtener preguntas:', error);
            }
        },

        /**
         * 
         *  funciones post
         * 
         */

        async PostCliente() {
            try {
                const response = await axios.post('app/controller/clients/PostCreateCliente', this.formClientes);

                console.log(response.data);
                this.Respuestas = response.data;
                this.formPreguntas.Email = '';
                this.formPreguntas.Nombre = '';
                this.FlagClient = false;
                console.log(this.FlagClient);

            } catch (error) {
                console.error('Error al obtener preguntas:', error);
            }
        },

        async PostPregunta() {
            try {
                const response = await axios.post('app/controller/questions/PostCreateQuestion', this.formPreguntas);
                console.log(response.data);
            } catch (error) {
                console.error('Error al obtener preguntas:', error);
            }
        },

        async PostCreateData() {
            try {
                // Validación de datos en blanco
                if (!this.formData.pregunta || !this.formData.respuesta) {
                    // Muestra una alerta con SweetAlert si algún campo está en blanco
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor, completa todos los campos antes de enviar.',
                    });
                    return; // Detener la ejecución si hay campos en blanco
                }
        
                const response = await axios.post('app/controller/data/PostCreateData', this.formData);
        
                if(response.data == true){
                    this.formData.pregunta = null;
                    this.formData.respuesta = null;

                    this.Toast.fire({
                        icon: "success",
                        title: "Pregunta respondida con exito"
                      });
                      
                }else {
                    this.Toast.fire({
                        icon: "error",
                        title: "error a responser la pregunta"
                      });
                }
        
            } catch (error) {
                console.error('Error al obtener preguntas:', error);
            }
        },

        /**
         * 
         *  funciones delete
         * 
         */

        async DeletePregunta(idPregunta) {
            try {
                const confirmacion = await Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede revertir.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                });
        
                if (confirmacion.isConfirmed) {
                    const response = await axios.delete(`app/controller/questions/DeleteQuestion/${idPregunta}`);
        
                    console.log(response.data);
                    if (response.data == true) {
                        // Pregunta eliminada con éxito
                        this.Toast.fire({
                            icon: 'success',
                            title: 'Pregunta eliminada con éxito'
                        });
        
                        // Puedes realizar alguna acción adicional si es necesario, como recargar la lista de preguntas
                        this.GetAllPreguntas();
        
                    } else {
                        // Error al intentar eliminar la pregunta
                        this.Toast.fire({
                            icon: 'error',
                            title: 'Error al intentar eliminar la pregunta'
                        });
                    }
                }
            } catch (error) {
                console.error('Error al eliminar pregunta:', error);
            }
        },
        
        


        /**
         * 
         *  funciones preguntas 
         * 
         */

        SeleccionarPregunta(question) {
            this.formData.pregunta = question;
        },


        /**
         * 
         *  funciones paginador
         * 
         */


        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },


    },


});
app.mount('#app');