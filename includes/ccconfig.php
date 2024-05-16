<?php
$pdo =new PDO('mysql:host=127.0.0.1; charset=utf8', 'root', '', array(
    PDO::MYSQL_ATTR_DIRECT_QUERY => false,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
));

foreach($pdo->query('SHOW DATABASES', PDO::FETCH_NUM) as $row ){
    echo $row[0], "<br />\r\n";
}