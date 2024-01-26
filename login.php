<?php require 'app/utils/helpers.php' ?>

<!DOCTYPE html>
<html lang="es">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
    <link rel="icon" href="assets/icons/thor.png" type="image/png">
    <!-- normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    <link rel="stylesheet" href="<?= CSS ?>login.css">
    <!-- css -->
    <link rel="stylesheet" href="<?= CSS ?>preloader.css">
</head>


<body>

    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <main>
        <div id="app">
            <div class="container-sm mt-5 py-5 text-center">

                <div class="container mt-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="card px-5 py-5" id="form1">
                                <form @submit.prevent="Login">

                                    <img src="assets/icons/thor.png" alt="" width="50" height="50">


                                    <h1 class="h3 mb-3 fw-normal">Ingrese sus datos</h1>
                                    <span class="text-danger">{{ error }}</span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="correo" placeholder="usuario"
                                            v-model="requestFormLogin.username">
                                        <label for="correo"> Usuario</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="contraseña"
                                            placeholder="Password" autocomplete="current-password"
                                            v-model="requestFormLogin.password">

                                        <label for="password">Contraseña</label>
                                    </div>
                                    <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">

                                    <button type="submit" class="btn btn-dark btn-sm mt-4 mb-4">Entrar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <!-- vuejs -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script src="<?=APP?>login.js">
    </script>

    <script src="<?=JS?>preloader.js">
    </script>

</body>

</html>