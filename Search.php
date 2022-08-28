<?
        //Connect
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $db_name = 'test_inline';
    
        $link = mysqli_connect($host, $user, $password, $db_name);

        //"Ловим" данные для поиска
        $json = $_POST['myData'];
        $json = json_decode($json);  
        
        $query = "SELECT * FROM comm WHERE body LIKE '%$json%'";
        $resultComm = mysqli_query($link, $query) or die(mysqli_error($link));
        $rows = 0;
        if($resultComm) 
            $rows = mysqli_num_rows($resultComm);
            if($rows < 1) {
            //Менее 3х символов
            echo ('<br>Результатов не найдено');
            } else {
                //Инициация массивов для данных
                $arrayPost = [];
                $arrayPostTitle = [];
                $arrayComm = [];
                echo("<br>");
                //Работа с комментариями
                if($resultComm) {
                    $rows = mysqli_num_rows($resultComm);
                    $col = mysqli_num_fields($resultComm);
                    for ($i = 0 ; $i < $rows; ++$i) {
                        $row = mysqli_fetch_row($resultComm);
                        //Собираем id постов
                        $arrayPost[$i] = $row[0];
                        //Собираем комментарии
                        $arrayComm[$i] = array($row[0],"EMAIL: " . $row[3] . "\nCOMM: " . $row[4] . " ");
                    }
                    //Убираем дубликаты
                    $arrayPost = array_unique($arrayPost);
                    $qPost = implode(",", $arrayPost);
                    $arrayPost = explode(",",$qPost);
                }
                //Ищем в БД посты, удовлетворяющие результатам поиска
                $query = "SELECT title FROM post WHERE id IN (" . "$qPost" . ")";
                $resultPost = mysqli_query($link, $query) or die(mysqli_error($link));
                if($resultPost) {
                    $rows = mysqli_num_rows($resultPost);
                    for ($i = 0 ; $i < $rows; ++$i) {
                        $row = mysqli_fetch_row($resultPost);
                        $arrayPostTitle[$arrayPost[$i]] = $row[0]; //Номер элемента в массиве (title) равен id поста
                    }
                }
                //Выводим результаты поиска
                echo('<table border="1">');
                echo('<tr><td>Наименование поста</td><td>Комментарий</td></td>');
                foreach ($arrayPostTitle as $key => $value){
                    echo('<tr><td>');
                    echo($value);
                    echo('</td><td>');
                    echo('<table>');
                    for ($i = 0; $i < count($arrayComm); ++$i) {
                        //Выводим комментарии
                        if ($key == $arrayComm[$i][0]) {
                            echo('<tr><td>');
                            echo(nl2br($arrayComm[$i][1]));
                            echo('</td></tr>'); 
                        }
                    }
                    echo('</table>');
                    echo('</td></tr>');    
                }
                echo('</table>');
            }
?>