<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Терминал для заказа пиццы</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="container">
    <h3>Терминал для заказка пиццы</h3>
        <form id="pizzaForm" method="post">
            <select name="pizza_id" id="">
                <option value="1">Пепперони</option>
                <option value="2">Деревенская</option>
                <option value="3">Гавайская</option>
                <option value="4">Грибная</option>
            </select>
            <select name="size_id" id="">
                <option value="1">21</option>
                <option value="2">26</option>
                <option value="3">31</option>
                <option value="4">45</option>
            </select>
            <select name="sauce_id" id="">
                <option value="1">Сырный</option>
                <option value="2">Кисло-сладкий</option>
                <option value="3">Чесночный</option>
                <option value="4">Барбекю</option>
            </select>
            <button type="submit">Заказать</button>
        </form>
    <div id="check"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="public/js/script.js"></script>
</body>
</html>