<?php
  header('Content-Type: text/html; charset=UTF-8');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'GET'){
      if (empty($_SERVER['PHP_AUTH_USER']) ||
      empty($_SERVER['PHP_AUTH_PW']) ||
      $_SERVER['PHP_AUTH_USER'] != 'admin' ||
      md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
      header('HTTP/1.1 401 Unanthorized');
      header('WWW-Authenticate: Basic realm="My site"');
      print('<h1>401 Требуется авторизация</h1>');
      exit();
    }

    print('Вы успешно авторизовались как администратор и видите защищенные паролем данные.');
    ?>
    <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
      
    </head>
    <body>
      <form action="" method = "POST">
      <div style="margin: 50px;">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>email</th>
            <th>Дата</th>
            <th>Пол</th>
            <th>Количество конечностей</th>
            <th>Биография</th>
            <th>действие</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $user = 'u52871';
        $password = '8321624';
        $database = new PDO('mysql:host=localhost;dbname=u52871', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $rows = 10; 
        $cols = 8; 
        $result = $database -> query("SELECT * FROM Person ");
          while($row = $result -> fetch()){
            echo "<tr>
            <td>". $row["person_id"] ."</td> 
            <td>". $row["name"] ."</td>
            <td>". $row["email"] ."</td>
            <td>". $row["date"] ."</td>
            <td>". $row["gender"] ."</td>
            <td>". $row["limb"] ."</td>
            <td>". $row["bio"] ."</td>
            <td>
            <a class= 'btn btn-primary' role= 'button' href = 'delete.php?rn=".$row["person_id"]."'> Удалить </a>
            </td>
            </tr>"
            ;
          }
          echo '</tr>';
        ?>
        </tbody>
      </table>
      <div class="">
        <p>
          Статистика пользователей
        </p>
        <?php
      $result1 = $database -> query("SELECT * FROM Connection WHERE ability_id  = 1");
      $result2 = $database -> query("SELECT * FROM Connection WHERE ability_id  = 2");
      $result3 = $database -> query("SELECT * FROM Connection WHERE ability_id  = 3");
      $count1 = 0;
      $count2 = 0;
      $count3 = 0;
      while($rowCon = $result1 -> fetch()){
        if($rowCon['ability_id'] == 1){
          $count1++;
        }
      }
      while($rowCon = $result2 -> fetch()){
        if($rowCon['ability_id'] == 2){
          $count2++;
        }
      }
      while($rowCon = $result3 -> fetch()){
        if($rowCon['ability_id'] == 3){
          $count3++;
        }
      }
      echo '<p style = "margin-bottom: 5px;">Левитацией обладает - '.$count1.' пользователей</p>';
      echo '<p style = "margin-bottom: 5px;">Бессметрием обладает - '.$count2.' пользователей</p>';
      echo '<p style = "margin-bottom: 5px;">Прохождением сквозь стены обладает - '.$count3.' пользователей</p>';
      ?>
      </div>
      </div>
      <div class = "w-25 p-3" style="margin: 50px;" >
      <input name = "User_Record" type = "text" placeholder = "ID пользователя" class="form-control">
      <input type = "submit" value = "Редактировать" class="form-control">
      </div>
      </form>
    </body>
    <?php
    if (!empty($_GET['none']))
    {
        $message = "Неверные данные!";
        print($message);
    }
  }
  else
  {
      $user_record = $_POST['User_Record'];
      $_SESSION['login'] = 'Admin';
      $_SESSION['uid'] = $user_record;
      header('Location: ./');
  }
?>

