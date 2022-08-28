<?
    //Загружаем JSON данные
    $comments = file_get_contents('https://jsonplaceholder.typicode.com/comments');
    $posts = file_get_contents('https://jsonplaceholder.typicode.com/posts');

    $commForDb = json_decode($comments);
    $postForDb = json_decode($posts);
    
    //Работа с БД
    //Connect
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'test_inline';

    $link = mysqli_connect($host, $user, $password, $db_name);

    //Очищаем БД
    $queryClearTable = "DELETE FROM comm";
    $result = mysqli_query($link, $queryClearTable) or die(mysqli_error($link));
    
    $queryClearTable = "DELETE FROM post";
    $result = mysqli_query($link, $queryClearTable) or die(mysqli_error($link));
    
    //Работа с ПОСТАМИ -БД-
    //Загружаем данные в таблицы
    for ($i = 0; $i < count($postForDb); $i++) {

        $array = get_object_vars($postForDb[$i]);
        $userId = (int)$array['userId'];
        $id = (int)$array['id'];
        $title = $array['title'];
        $body = $array['body'];

        $queryIsertPost = "INSERT INTO post VALUES ('$userId','$id','$title', '$body') ";
        $result = mysqli_query($link, $queryIsertPost) or die(mysqli_error($link));

    }
    
    //Работа с КОММЕНТАРИЯМИ -БД-
    //Загружаем данные в таблицы
    for ($i = 0; $i < count($commForDb); $i++) {

        $array = get_object_vars($commForDb[$i]);
        $postId = (int)$array['postId'];
        $id = (int)$array['id'];
        $name = $array['name'];
        $email = $array['email'];
        $body = $array['body'];

        $queryIsertComm = "INSERT INTO comm VALUES ('$postId','$id','$name','$email','$body') ";
        $result = mysqli_query($link, $queryIsertComm) or die(mysqli_error($link));

    }
    echo ('<br> Загружено ' . count($postForDb) . ' записей и ' . count($commForDb) . ' комментариев! <br><br>');

?>