
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
<body>
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal text-center">Список задач</h1>
            <p class="lead font-weight-normal text-center">Ниже приведен список задач</p>
            <?php if ($this->request->isAuthenticated()) { ?>
                <a class="btn btn-lg btn-primary btn-block" href="/logout">Выйти</a>
            <?php } else { ?>
                <a class="btn btn-lg btn-primary btn-block" href="/login">Войти</a>
            <?php } ?>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
    <div class="col-md-11 my-5 mx-auto">
        <?php
            if (isset($message)) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?= $message ?>
                    </div>
                <?php
            }
        ?>
        <h1>Список всех задач</h1>
        <form method="get" action="/" class="my-4">
            <input type="hidden" value="<?= $pagination["currentPage"] ?>" name="page">
            <label for="exampleFormControlSelect1">
                <?php
                    /** @var $sort */
                    $sortedBy = $sort["sortedBy"];
                    $orderedBy = $sort["orderedBy"];
                ?>
                <select class="form-control" name="sort" id="exampleFormControlSelect1">
                    <option value="name" <?= $sortedBy === 'name' ? 'selected' : '' ?>>Сортировать по Имени</option>
                    <option value="email" <?= $sortedBy === 'email' ? 'selected' : '' ?>>Сортировать по Емайлу</option>
                    <option value="status" <?= $sortedBy === 'status' ? 'selected' : '' ?>>Сортировать по Статусу</option>
                </select>
            </label>
            <label for="exampleFormControlSelect">
                <select class="form-control" name="order" id="exampleFormControlSelect">
                    <option value="asc" <?= $orderedBy === 'asc' ? 'selected' : '' ?>>Сортировать по ASC</option>
                    <option value="desc" <?= $orderedBy === 'desc' ? 'selected' : '' ?>>Сортировать по DESC</option>
                </select>
            </label>
            <button class="btn btn-success ml-2" type="submit">Применить фильтры</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Емайл пользователя</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата добавления</th>
                    <?php if ($this->request->isAuthenticated()) { ?>
                        <th scope='col'>Управление</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>

            <?php

            /** @var $tasks */
            foreach ($tasks as $key => $task) {
                ?>
                <tr>
                    <th scope='col'><?= $key+1 ?></th>
                    <th scope='col'><?= $task->email ?></th>
                    <th scope='col'><?= $task->name ?></th>
                    <th scope='col'><?= $task->description ?></th>
                    <th scope='col'><?= $task->status === 0 ? 'Выполнена' : 'Отредактирована администратором' ?></th>
                    <th scope='col'><?= $task->created_at ?></th>
                    <?php if ($this->request->isAuthenticated()) { ?>
                    <th scope='col'><a href="<?= "/edit?id=$task->id" ?>">Редактировать</a></th>
                    <?php } ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle ml-2 mb-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Добавить задачу
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form class="px-4 py-3" @submit.prevent="submitForm" id="createTaskForm">
                    <div class="form-group">
                        <label for="">Емайл пользователя</label>
                        <input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" name="email" v-model="form.email" placeholder="Емайл">
                        <div class="invalid-feedback" v-if="errors.email">
                            <li v-for="error in errors.email">
                                {{ error }}
                            </li>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Наименование</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" name="name" v-model="form.name" placeholder="Наименование">
                        <div class="invalid-feedback" v-if="errors.name">
                            <li v-for="error in errors.name">
                                {{ error }}
                            </li>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Описание</label>
                        <textarea class="form-control" :class="{ 'is-invalid': errors.description }" name="description" v-model="form.description" placeholder="Описание"></textarea>
                        <div class="invalid-feedback" v-if="errors.description">
                            <li v-for="error in errors.description">
                                {{ error }}
                            </li>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать новую задачу</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/login">Перейти на страницу авторизации</a>
            </div>
        </div>

        <ul class="pagination pagination-lg d-flex justify-content-center mt-5">
            <?php
            /** @var array $pagination */
            for ($i = 1; $i <= $pagination["totalPages"]; $i++) {
                if ($pagination["currentPage"] == $i) {
                ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><?= $i ?></a>
                    </li>
                <?php
                } else {

                    if ($i === 1) {
                        $linkArr = ["sort" => $sortedBy, "order=$orderedBy"];
                    } else {
                        $linkArr = ["page=$i", "sort=$sortedBy", "order=$orderedBy"];
                    }
                ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= implode('&', $linkArr) ?>"><?= $i ?></a>
                    </li>
                <?php
                }
            }
            ?>
        </ul>
    </div>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">Тестовое задание для beejee.ru</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/js/create-task-form.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>