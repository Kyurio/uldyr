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

            Respuestas: [],

            FlagClient: true,


        }

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
        }


    },
    

});
app.mount('#app');