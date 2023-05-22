<?php
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "ru_RU.UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() + 24 * 60 * 60);
        setcookie('login', '', time() + 60 * 60 * 24);
        setcookie('password', '', time() + 60 * 60 * 24);
        $messages[] = 'Данные были сохранены!';
        if (!empty($_COOKIE['password']))
        {
            $messages[] = sprintf('<div class="error_message"> Вы можете войти с логином и паролем для изменения данных:</div>
            <div class="error_message">Логин: <strong>%s</strong>.</div>
            <div class="error_message">Пароль: <strong>%s</strong>.</div>',
            
            strip_tags($_COOKIE['login']),
            strip_tags($_COOKIE['password'])
        );

        
    }
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
        $messages[] = '<div class="error">Заполните имя</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Заполните почту</div>';
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
        setcookie('Superpowers_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите суперсилы.</div>';
    }
    if ($errors['contract']) {
        setcookie('contract_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Согласитесь с условиями.</div>';
    }
    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
    {
        $user = 'u52871';
        $password = '8321624';
        $database = new PDO('mysql:host=localhost;dbname=u52871', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $statement = $database -> prepare("SELECT * FROM Person WHERE person_id = ?");
        $statement -> execute([$_SESSION['uid']]);
        $line = $statement -> fetch(PDO::FETCH_ASSOC);

        $values = array();
        $values['name'] = $line['name'];
        $values['email'] = $line['email'];
        $values['date'] = $line['date'];
        $values['gender'] = $line['gender'];
        $values['limb'] = $line['limb'];
        //$values['Superpowers'] = $line['Superpowers'];
        $values['bio'] = $line['bio'];
        $values['contract'] = $line['contract'];
        $messages[] = sprintf('<div class="error_message"> Вход с логином  и номером пользователя: </div>
        <div class="error_message">Логин: <strong>%s</strong>.</div>
        <div class="error_message">Номер пользователя: <strong>%s</strong>.</div>',
        
        strip_tags($_SESSION['login']),
        strip_tags($_SESSION['uid'])
    );
       
    }

    else
    {
        $values = array();
        $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
        $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
        $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
        $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
        $values['limb'] = empty($_COOKIE['limb_value']) ? '' : $_COOKIE['limb_value'];
        $values['Superpowers'] = empty($_COOKIE['Superpowers_value']) ? '' : $_COOKIE['Superpowers_value'];
        /*$values['Superpowers1'] = empty($_COOKIE['Superpowers_value1']) ? '' : $_COOKIE['Superpowers_value1'];
        $values['Superpowers2'] = empty($_COOKIE['Superpowers_value2']) ? '' : $_COOKIE['Superpowers_value2'];
        $values['Superpowers3'] = empty($_COOKIE['Superpowers_value3']) ? '' : $_COOKIE['Superpowers_value3'];*/
        $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
        $values['contract'] = empty($_COOKIE['contract_value']) ? '' : $_COOKIE['contract_value'];
    }
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
        setcookie('Superpowers_error', '', 100000);
        setcookie('bio_error', '', 100000);
        setcookie('contract_error', '', 100000);
    }
    //*************************

    $user = 'u52871';
    $password = '8321624';
    
    try {
        $database = new PDO('mysql:host=localhost;dbname=u52871', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
            {
                $person_id = $_SESSION['uid'];
                $statement = $database -> prepare("UPDATE Person SET name = ?, email = ?, date = ?, gender = ?, limb = ?, bio = ?, contract = ? WHERE person_id = ?");
                $statement -> execute([$_POST['name'], $_POST['email'], $_POST['date'], $_POST['gender'], $_POST['limb'], $_POST['bio'], $_POST['contract'], $_SESSION['uid']]);
                $result = $database -> exec("DELETE FROM Connection WHERE person_id = '$person_id'");
                $statement_sup = $database -> prepare("INSERT INTO Connection SET ability_id = ?, person_id = ? ");
                foreach($_POST['Superpowers'] as $superpowers)
                    $statement_sup -> execute([$superpowers, $_SESSION['uid']]);
            }

            else
            {
                $user_login = uniqid('', true);
                $user_password = rand(11, 111);
                setcookie('login', $user_login);
                setcookie('password', $user_password);

                 //отправка данных в базу
                $statement = $database -> prepare("INSERT INTO Person (name, email, date, gender, limb, bio, contract) VALUES (:name, :email, :date, :gender, :limb, :bio, :contract)");
                $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'date' => $_POST['date'], 'gender' => $_POST['gender'], 'limb' => $_POST['limb'], 'bio' => $_POST['bio'], 'contract' => $_POST['contract']]);
                $id_connection = $database -> lastInsertId();
                $statement = $database -> prepare("INSERT INTO Connection (person_id, ability_id) VALUES (:person_id, :ability_id)");
                foreach ($_POST['Superpowers'] as $superpowers)
                {
                    if ($superpowers != false)
                    {
                        $statement -> execute(['person_id' => $id_connection, 'ability_id' => $superpowers]);
                    }
                }
                $statement = $database -> prepare("INSERT INTO User_Information SET ID_User = ?, User_Login = ?, User_Password = ?");
                $statement -> execute([$id_connection, $user_login, md5($user_password)]);
            }

            setcookie('save', '1');
            header('Location: index.php');
        }

    

    