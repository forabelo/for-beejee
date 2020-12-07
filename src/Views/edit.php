
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
    </div>
    <div class="product-device box-shadow d-none d-md-block"></div>
    <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
</div>
<div class="col-md-11 my-5 mx-auto">
    <h1>Редактирование задачи:
        <?=
            /** @var $task */
            $task->name
        ?>
    </h1>
    <form class="px-4 py-3" action="" method="post" id="editTaskForm">
        <input type="hidden" value="<?= $task->id ?>" name="id">
        <div class="form-group">
            <label for="">Емайл пользователя</label>
            <input type="email" class="form-control" name="email" value="<?= $task->email ?>" required placeholder="Емайл">
        </div>
        <div class="form-group">
            <label for="">Наименование</label>
            <input type="text" class="form-control" name="name" value="<?= $task->name ?>" required placeholder="Наименование">
        </div>
        <div class="form-group">
            <label for="">Описание</label>
            <textarea class="form-control" name="description" required placeholder="Описание"><?= $task->description ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать новую задачу</button>
    </form>
</div>
<footer class="footer">
    <div class="container">
        <span class="text-muted">Тестовое задание для beejee.ru</span>
    </div>
</footer>
</body>
</html>