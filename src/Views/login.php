
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product example for Bootstrap</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="text-center">
<div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light">
    <div class="col-md-4 p-lg-5 mx-auto my-5">
        <form @submit.prevent="submitForm" id="loginForm">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Пожалуйста, авторизуйтесь</h1>
            <div class="form-group">
                <input type="text" class="form-control" :class="{ 'is-invalid': errors.login }" name="name" v-model="form.login" placeholder="Логин">
                <div class="invalid-feedback" v-if="errors.login">
                    <li v-for="error in errors.login" class="list-group-item">
                        {{ error }}
                    </li>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" name="name" v-model="form.password" placeholder="Пароль">
                <div class="invalid-feedback" v-if="errors.password">
                    <li v-for="error in errors.password" class="list-group-item">
                        {{ error }}
                    </li>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-<?= date('Y') ?></p>
        </form>
        <a href="/" class="mt-2 float-left">Перейти на главную страницу</a>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <span class="text-muted">Тестовое задание для beejee.ru</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/js/login-form.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>