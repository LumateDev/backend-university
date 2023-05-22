<?php
$user_id = $_GET['rn'];
    $user = 'u52871';
    $password = '8321624';
    $database = new PDO('mysql:host=localhost;dbname=u52871', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $database -> exec("delete from Person where person_id = '$user_id'");

    $result = $database -> exec("delete from Connection where person_id = '$user_id'");

    header('Location: ./admin.php');
?>
