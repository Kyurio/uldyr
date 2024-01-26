const app = Vue.createApp({
    data() {

        return {

            requestFormLogin: {

                username: '',
                password: ''

            },

            csrfToken: '',
            error: '',

        }

    },

    methods: {


        Login() {
            try {

                this.csrfToken = document.querySelector('input[name="csrf_token"]').value;
                axios.defaults.headers.common['X-CSRF-TOKEN'] = this.csrfToken;
                axios.post('app/controller/Login', this.requestFormLogin)
                    .then(response => {

                        if (response.data == true) {
                            location.href = 'index';
                        } else {
                            this.error = 'Usuario o Contraseña incorrectos';
                        }

                    })
                    .catch(error => {
                        console.error('Error al realizar la solicitud:', error);
                    });
            } catch (error) {
                console.error('Error al guardar el producto:', error);
            }
        },

    }

});

app.mount('#app');