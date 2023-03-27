<?php
    try
    {
    
    //подключаемся к базе данных
    $user = 'u52871';
    $password = '8321624';
    $database = new PDO('mysql:host=localhost;dbname=u52871',
    $user,$password,[PDO::ATTR_PERSISTENT => true]);

    //проверка полей на заполненность
    if (empty($_POST['name'])) exit ("Поле ИМЯ не заполнено!");
    
    if ($_POST['name']==$name) exit("Поле ИМЯ заполненно неккоректно");
    if (empty($_POST['email'])) exit ("Поле ПОЧТА не заполнено!");
    if ($_POST['date'] == "гггг-мм-дд") exit ("Поле ДАТА не заполнено!");
    if ($_POST['gender'] == false) exit ("ПОЛ не выбран!");
    if ($_POST['limb'] == false) exit ("КОЛ-ВО КОНЕЧНОСТЕЙ не выбрано!");
    //if (empty($_POST['superpowers'])) exit ("СУПЕРСПОСОБНОСТИ не выбраны!");
    if (empty($_POST['bio'])) exit ("Поле БИОГРАФИЯ не заполнено!");
    if ($_POST['contract'] == false) exit ("Кнопка КОНТРАКТ не нажата!");
    foreach ($_POST['Superpowers'] as $superpowers)
        {
            if (!$superpowers > 0 && !$superpowers < 4)
            exit ("Выбрано некорректное значение СУПЕРСПОСОБНОСТЕЙ!");
        }

    //отправка данных в базу
    $statement = $database->prepare("INSERT INTO Person (name,email,date,gender,limb,bio,contract) VALUES (:name,:email,:date,:gender,:limb,:bio,:contract)");
    $statement -> execute(['name'=>$_POST['name'], 'email'=>$_POST['email'], 'date'=>$_POST['date'], 'gender'=>$_POST['gender'], 'limb'=>$_POST['limb'], 'bio'=>$_POST['bio'], 'contract'=>$_POST['contract']]);
    $id_connection = $database->lastInsertId();
    $statement = $database -> prepare("INSERT INTO Connection (person_id, ability_id) VALUES (:person_id, :ability_id)");
        foreach ($_POST['Superpowers'] as $superpowers)
        {
            if ($superpowers != false)
            {
                $statement -> execute(['person_id' => $id_connection, 'ability_id' => $superpowers]);
            }
        }
    }
    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e->getMessage());
        exit();
    }

?>