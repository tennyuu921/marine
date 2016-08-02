<?php

$dsn = 'mysql:dbname=marine;host=localhost';
$user = 'root';
$password = '';

    try{
        $dbh = new PDO($dsn, $user, $password);
        if ($dbh == null){
            print('接続に失敗しました。<br>');
        }else{
        }

    }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

?>