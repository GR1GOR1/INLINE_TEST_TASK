<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INLINE</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        include 'TakeInfo.php';
    ?>
    <h3>Введите фразу для поиска</h3>
        <input class="SearchInput" type="text" id="input_form">
        <button class="SearchButton" onclick="SearchClick()">Найти</button>
    <div class = "BlockOut"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts.js"></script>

</body>
</html>