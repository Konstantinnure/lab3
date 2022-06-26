<?php

require_once __DIR__ . '/models/Model.php';
$model = new Model();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Library</title>
</head>
<body>
    <form action="" id="form-publisher">
        <label for="publisher">Издательство:</label>
        <select name="publisher" id="publisher">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach ($model->get_publishers() as $publisher) { ?>
                <option value="<?= $publisher['publisher'] ?>"><?= $publisher['publisher'] ?></option>
            <? } ?>
        </select>
    </form>
    <br>
    <div id="display-publisher"></div>
    <br>
    <form action="" id="form-date">
        <label for="">Диапазон:</label>
        <input type="date" name="date_from">
        <input type="date" name="date_to">
        <button name="send">Отправить</button>
    </form>
    <br>
    <div id="display-date"></div>
    <br>
    <form action="" id="form-author">
        <label for="author">Автор:</label>
        <select name="author" id="author">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach ($model->get_authors() as $author) { ?>
                <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
            <? } ?>
        </select>
    </form>
    <br>
    <div id="display-author"></div>
    <script src="script.js"></script>
</body>
</html>
