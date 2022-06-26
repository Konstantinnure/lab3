<?php

require_once dirname(dirname(__FILE__)) . '/models/model.php';
$model = new Model();
$res = '';

foreach ($_GET as $key => $value) {
    switch ($key) {
        case 'publisher':
            $res = '<table border="2" cellpadding="3"><tr><th>Название</th><th>Год выпуска</th><th>Страниц</th><th>ISBN</th></tr>';
            foreach ($model->get_books_by_publisher($value) as $el) {
                $res .= '<tr>';
                $res .= '<td>' . $el['name'] . '</td><td>' . $el['year'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td>';
                $res .= '</tr>';
            }
            $res .= '</table>';

            echo json_encode($res);
            break;
        case 'author':
            $res = '<?xml version="1.0" encoding="UTF-8" ?><document>';
            $res .= '<table border="2" cellpadding="3"><tr><th>Название</th><th>Год выпуска</th><th>Страниц</th><th>ISBN</th></tr>';
            foreach ($model->get_books_by_author($value) as $el) {
                $res .= '<tr>';
                $res .= '<td>' . $el['name'] . '</td><td>' . $el['year'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td>';
                $res .= '</tr>';
            }
            $res .= '</table></document>';

            echo $res;
            break;
        case 'date_from':
            $res = '<table border="2" cellpadding="3"><tr><th>Название</th><th>Дата выпуска</th><th>Год выпуска</th><th>Издание</th><th>Страниц</th><th>ISBN</th><th>Номер</th><th>Тип</th><th>Ресурс</th></tr>';
            foreach ($model->get_literature_by_date($value, $_GET['date_to']) as $el) {
                $res .= '<tr>';
                $res .= '<td>' . $el['name'] . '</td><td>' . (isset($el['date']) ? date('d.m.Y', strtotime($el['date'])) : '') . '</td><td>' . $el['year'] . '</td><td>' . $el['publisher'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td><td>' . $el['number'] . '</td><td>' . $el['literate'] . '</td><td>' . $model->get_recource($el['idResource'])['title'] . '</td>';
                $res .= '</tr>';
            }
            $res .= '</table>';

            echo $res;
            break;
    }
}