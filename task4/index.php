<?php
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "ru_RU.UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() + 24 * 60 * 60);
        $messages[] = 'Результаты были сохранены!';
    }
    //  Массив для хранения ошибок
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['limb'] = !empty($_COOKIE['limb_error']);
    $errors['Superpowers'] = !empty($_COOKIE['Superpowers_error']);
    $errors['bio'] = !empty($_COOKIE['bio_error']);
    $errors['contract'] = !empty($_COOKIE['contract_error']);

    //  Сообщения об ошибках
    if ($errors['name']) {
        setcookie('name_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите name.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите email.</div>';
    }
    if ($errors['date']) {
        setcookie('date_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите дату рождения.</div>';
    }
    if ($errors['gender']) {
        setcookie('gender_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите пол.</div>';
    }
    if ($errors['limb']) {
        setcookie('limb_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
    }
    if ($errors['Superpowers']) {
        setcookie('superpowers_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите суперсилы.</div>';
    }
    if ($errors['contract']) {
        setcookie('contract_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Согласитесь с условиями.</div>';
    }

    //  Сохраняем значения полей в массив
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['limb'] = empty($_COOKIE['limb_value']) ? '' : $_COOKIE['limb_value'];
    $values['Superpowers'] = empty($_COOKIE['Superpowers_value']) ? '' : $_COOKIE['Superpowers_value'];
    $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
    $values['contract'] = empty($_COOKIE['contract_value']) ? '' : $_COOKIE['contract_value'];

    //  Включаем файл form.php
    //  в него передаются переменные $messages, $errors, $values
    include('form.php');
} else {
    //  Если метод был POST
    //  Флаг для отлова ошибок полей
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u', $_POST['name'])) {
            setcookie('name_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('name_value', $_POST['name'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST['email'])) {
            setcookie('email_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('email_value', $_POST['email'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['date'])) {
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[1-2][0|9|8][0-9][0-9]-[0-1][0-9]-[0-3][0-9]+$/', $_POST['date'])) {
            setcookie('date_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('date_value', $_POST['date'], time() + 31 * 24 * 60 * 60);
        }
    }
    if(empty($_POST['gender'])){setcookie('gender_error', '1',time() + 24 * 60 * 60);$errors = TRUE; }
    else
    {
        if($_POST['gender'] != "М" && $_POST['gender'] != "Ж"){
            setcookie('gender_error','2',time() + 24 * 60 * 60 * 31);
            $errors = TRUE;
        }
        else{
            setcookie('gender_value', $_POST['gender'], time() + 24 * 60 * 60);
        }

    }
    if(empty($_POST['limb'])){setcookie('limb_error', '1',time() + 24 * 60 * 60);$errors = TRUE; }
    else
    {
        if($_POST['limb'] != 2 && $_POST['limb'] != 3 && $_POST['limb'] != 4 ){
            setcookie('limb_error','2',time() + 24 * 60 * 60 * 31);
            $errors = TRUE;
        }
        else{
            setcookie('limb_value', $_POST['limb'], time() + 24 * 60 * 60);
        }

    }

    if (empty($_POST['Superpowers'])) { setcookie('Superpowers_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
    else
    {
        setcookie("Superpowers_error","",1000000);
        setcookie("1","",1000000);
        setcookie("2","",1000000);
        setcookie("3","",1000000);
        $super=$_POST["Superpowers"];
        foreach($super as $cout){
          if($cout =="1"){
            setcookie("1","true");
          }
          if($cout =="2"){
            setcookie("2","true");
          }
          if($cout =="3"){
            setcookie("3","true");
          }
        }
    }

    
    if (empty($_POST['bio'])) { setcookie('bio_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
    else
    {
        if (empty($_POST['bio']) || is_numeric($_POST['bio']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['bio']))
        {
            setcookie('bio_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        }
        else setcookie('bio_value', $_POST['bio'], time() + 60 * 60 * 24 * 31);
    }


    if (empty($_POST['contract'])) { setcookie('contract_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
    else
    {
        if ($_POST['contract'] == null)
        {
            setcookie('contract_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        }
        else setcookie('contract_value', $_POST['contract'], time() + 60 * 60 * 24 * 31);
    }


    if ($errors) {
        header('Location: index.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limb_error', '', 100000);
        setcookie('superpowers_error', '', 100000);
        setcookie('bio_error', '', 100000);
        setcookie('contract_error', '', 100000);
    }
    //*************************

    $user = 'u52871';
    $pass = '8321624';
    
    try {
        $database = new PDO('mysql:host=localhost;dbname=u52871', $user, $pass, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    
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

    //*************************

    setcookie('save', '1');
    header('Location: index.php');
}