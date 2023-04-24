<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Task4</title>
</head>
<body>
<?php
  if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
}
    ?>
<div class="main">
    <form action="." method="POST">
    

      <div class="mb-3">
        <label for="InputName" class="form-label">Имя</label>
        <div class="form_item <?php if ($errors['name']) {
            print 'error';
        } ?>">
        <input type="text" class="form-control"name ="name" id="InputName" value="<?php print $values['name']; ?>">
        </div>
      </div>

        <div class="mb-3">
        <label for="InputEmail" class="form-label">Email адресс</label>
          <div class="form_item <?php if ($errors['email']) {
            print 'error';
        } ?>">
          <input type="email" class="form-control" id="InputEmail" name ="email" placeholder="Введите вашу почту" value="<?php print $values['email']; ?>" >
          </div>
        </div>

        <div class="mb-3">
          <div class="form_item <?php if ($errors['date']) {
            print 'error';
        } ?>">
          <label for="InputDate" class="form-label">Текстовое поле даты</label>
          <input type="date" class="form-control" name="date"  id="InputDate" value="<?php print $values['date']; ?>">
          </div>
        </div>

        <div class="mb-3">
          <label for="InputGender" class="form-label">Пол 
          <br>
          <div class="form_item <?php if ($errors['gender']) {
            print 'error';
        } ?>">
            <label> 
              М
              <input type="radio" class = "form-check-input" name="gender" value="М" <?php if ($values['gender'] == 'М') {print 'checked = "checked" ';} ?>>
            </label>
            <br>
            <label> 
              Ж
              <input type="radio" class = "form-check-input" name="gender" value="Ж" <?php if ($values['gender'] == 'Ж') {print 'checked = "checked" ';} ?>>
            </label>
          </div>
        </div>


        <div class="mb-3">
          <label for="InputLimbs" class="form-label">Выберете количество конечностей</label>
          <div class="form_item <?php if ($errors['limb']) {
            print 'error';
        } ?>">
          <br>
           <label>
             2
             <input type="radio" class = "form-check-input" name="limb" value=2 <?php if ($values['limb'] == 2) {print 'checked = "checked" ';} ?>>
           </label>
           <label>
             3
             <input type="radio" class = "form-check-input" name="limb" value=3   <?php if ($values['limb'] == 3) {print 'checked = "checked"';}?>>
           </label>
           <label>
             4
             <input type="radio" class = "form-check-input" name="limb" value=4 <?php if ($values['limb'] == 4) {print 'checked = "checked"';}?>>
           </label>
          </div>
        </div>

        <div class="mb-3">
          <span class="input-group-text">Сверхспособности</span>
          <div class="form_item <?php if ($errors['Superpowers']) {
            print 'error';
        } ?>">
          <select class="form-select" name="Superpowers[]" multiple = "multiple">
            <option  value = 1 <?php if (isset($_COOKIE["1"])) if ($_COOKIE["1"]=="true") echo "selected" ?> > Бессмертие </option>
            <option  value = 2 <?php if (isset($_COOKIE["2"])) if ($_COOKIE["2"]=="true") echo "selected" ?> > Прохождение сквозь стены </option>
            <option  value = 3 <?php if (isset($_COOKIE["3"])) if ($_COOKIE["3"]=="true") echo "selected" ?> > Левитация </option>
          </select>
          </div>
        </div>

        <div class="mb-3">
          
          <span class="input-group-text">Биография</span>
          <textarea class="form-control"  name="bio"<?php if ($errors['bio']) {print 'error';} ?>><?php print $values['bio']; ?></textarea>
  
        </div>


        <div class="mb-3 form-check">
        <div class="form_item <?php if ($errors['contract']) {
            print 'error';
        } ?>">
          <input type="checkbox" class="form-check-input" name="contract" value="checked"<?php if ($errors['contract']) {print 'error';} ?> <?php if ($values['contract'] == 'checked') {print 'checked="checked"';} ?>>
          <label class="form-check-label" for="exampleCheck1">С контрактом ознакомлен</label>
        </div>
        </div>

        <button type="submit" class="btn btn-secondary">Отправить</button>
      </form>
    </div>  
</body>
</html>