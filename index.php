<?php
require __DIR__ . '/vendor/autoload.php';


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Домашнее задание к лекции "Менеджер зависимостей Composer"</title>
</head>
<body>
<h2>Поиск координат по адресу объекта</h2>
<form method="post">
    <input name="search_address" type="text" placeholder="Введите адрес">
    <input type="submit" value="Найти">
</form>
<?php if (!empty($_POST['search_address'])) :
$searchAddress = $_POST['search_address'];
$api = new \Yandex\Geo\Api();
$api->setQuery($searchAddress);
try {
    $api
        ->setLang(\Yandex\Geo\Api::LANG_RU)
        ->load();
} catch  (Exception $err) {
    echo $err->getMessage();
}


$response = $api->getResponse();
$search = $response->getQuery();
$collection = $response->getList();
?>
<table>
    <tr>
        <th>Адрес объекта</th>
        <th>Широта</th>
        <th>Долгота</th>
    </tr>
    <?php foreach ($collection as $item) :?>
    <tr>
        <td><?=$item->getAddress();?></td>
        <td><?=$item->getLatitude();?></td>
        <td><?=$item->getLongitude();?></td>
    </tr>
    <?php endforeach;
endif; ?>
</table>

</body>
</html>
