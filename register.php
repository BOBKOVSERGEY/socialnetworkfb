<?php
require __DIR__ . '/init.php';

$fname = ""; // имя
$lname = ""; // фамилия
$em = ""; // email
$em2 = ""; // email2
$password = ""; // пароль
$password2 = ""; // пароль2
$date = ""; // дата регистрации
$error_array = [];// Ошибки
$uniqueId = abs( crc32( uniqid() ) );
//$uniqueId = time() . getmypid();

if (isset($_POST['register_button'])) {
// значения формы
// имя
  $fname = Base::security($_POST['reg_fname']); // html теги
  $_SESSION['reg_fname'] = $fname; // сохраняем имя в сессию

// фамилия
  $lname = Base::security($_POST['reg_lname']); // html теги
  $_SESSION['reg_lname'] = $lname; // сохраняем фамилию в сессию

// email
  $em = Base::security($_POST['reg_email']); // html теги
  $_SESSION['reg_email'] = $em; // сохраняем email в сессию

// email2
  $em2 = Base::security($_POST['reg_email2']); // html теги
  $_SESSION['reg_email2'] = $em2; // сохраняем email2 в сессию

// password
  $password = Base::security($_POST['reg_password']); // html теги
  $password2 = Base::security($_POST['reg_password2']); // html теги

  $date = date("Y-m-d"); // текущая дата

  if ($em == $em2) {
// промеряем email
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);


     // Проверяем, если email уже существует
      if (DB::query('SELECT email FROM users WHERE email=:email', [':email' => $em])) {
        array_push($error_array, "Email уже используется<br>");
      }

    } else {
      array_push($error_array,"Введите корректный email<br>");
    }
  } else {
    array_push($error_array,"Адреса электронной почты не совпадают<br>");
  }

  if (preg_match('/[^A-Za-z0-9]/', $fname)) {
    array_push($error_array, "Ваше имя может состоять только из латинских символов или чисел<br>");
  }
  if (preg_match('/[^A-Za-z0-9]/', $lname)) {
    array_push($error_array, "Ваша фамилия может состоять только из латинских символов или чисел<br>");
  }


  if (strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, "Ваше имя должно быть между 2 и 25 символами<br>");
  }

  if (strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "Ваша фамилия должна быть между 2 и 25 символами<br>");
  }



  if ($password != $password2) {
    array_push($error_array, "Ваши пароли не совпадают<br>");
  } else {
    if (preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Ваш пароль может состоять только из латинских символов или чисел<br>");
    }
  }

  if (strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "Ваш пароль должен быть между 5 и 30 символами<br>");
  }

// если ошибок нет
  if(empty($error_array)) {


//Generate username by concatenating first name and last name
    $username = $fname . "_" . $lname;

    // генерируем уникальное имя
    /*$check_username_query = DB::query('SELECT username FROM users WHERE username=:username', [':username'=>$username]);
    $i = 0;
//if username exists add number to username
    while( count($check_username_query)!= 0) {
      $i++; //Add 1 to i
      $username = $username . "_" . $i;
      $check_username_query = DB::query('SELECT username FROM users WHERE username=:username', [':username'=>$username]);
    }*/

//Profile picture assignment
    $rand = rand(1, 2); //Random number between 1 and 2

    if($rand == 1)
      $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
    else if($rand == 2)
      $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";


    DB::query("INSERT INTO users VALUES(null,
                                            :uniqueid,
                                            :fname,
                                            :lname,
                                            :username,
                                            :em,
                                            :password,
                                            :date,
                                            :profilepic,
                                            :numposts,
                                            :numlikes,
                                            :user_closed,
                                            :arrayfriends)", [':uniqueid' => $uniqueId,
                                                              ':fname' => $fname,
                                                              ':lname' => $lname,
                                                              ':username' => $username,
                                                              ':em' => $em,
                                                              ':password' => password_hash($password, PASSWORD_BCRYPT),
                                                              ':date' => $date,
                                                              ':profilepic' => $profile_pic,
                                                              ':numposts' => '0',
                                                              ':numlikes' => '0',
                                                              ':user_closed' => 'no',
                                                              ':arrayfriends' => ',',
                                                              ]);

    array_push($error_array, "Вы успешно зарегистрировались");

// clear session variables
    $_SESSION['reg_fname'] = '';
    $_SESSION['reg_lname'] = '';
    $_SESSION['reg_email'] = '';
    $_SESSION['reg_email2'] = '';

  }

}

if (isset($_POST['login_button'])) {

  $email = Base::security($_POST['log_email']);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $_SESSION['log_email'] = $email;

  $password = Base::security($_POST['log_password']);

  if (DB::query('SELECT * FROM users WHERE email=:email', [':email' => $email])) {
    if (password_verify($password, DB::query('SELECT password FROM users WHERE email=:email', [':email' => $email])[0]['password'])) {
      $user = DB::query('SELECT * FROM users WHERE email=:email', [':email' => $email]);
      $username = $user[0]['username'];
      $userUniqueId = $user[0]['unique_id'];

      if (DB::query('SELECT * FROM users WHERE email=:email AND user_closed=:yes', [':email' => $email, ':yes'=> 'yes'])) {
        DB::query('UPDATE users SET user_closed=:no WHERE email=:email', [':no' => 'no',':email' => $email]);
      }

      $_SESSION['username'] = $username;
      $_SESSION['unique_id'] = $userUniqueId;

      header("Location: /index.php");
      exit();
    } else {
      array_push($error_array, "Email или пароль некорректны<br>");
    }
  } else {
    array_push($error_array, "Email или пароль некорректны<br>");
  }

}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome</title>
  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/fontAweasome.css">
  <link rel="stylesheet" href="/assets/css/fonts.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="register__bg"></div>
<div class="login__caption">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="register__heading mb-3">Войдите или зарегистрируйтесь ниже!</h2>
        <div class="first">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="log_email" value="<?php if (isset($_SESSION['log_email'])) { echo $_SESSION['log_email']; }?>" placeholder="Введите email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="log_password" placeholder="Введите пароль">
            </div>
            <div class="text-danger">
              <?php if(in_array("Email или пароль некорректны<br>", $error_array)) echo "Email или пароль некорректны<br>"; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="login_button">Войти</button>
            <div class="mt-3"><a href="#" id="signUp" class="signUp text-white">Нужен аккаунт? Зарегистрируйтесь здесь!</a></div>
          </form>
        </div>
        <div class="second mt-3">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="reg_fname" placeholder="Ваше имя" value="<?php if (isset($_SESSION['reg_fname'])) { echo $_SESSION['reg_fname']; }?>" required>
              <div class="text-danger">
                <?php if (in_array("Ваше имя должно быть между 2 и 25 символами<br>", $error_array)) echo "Ваше имя должно быть между 2 и 25 символами<br>";
                else if (in_array("Ваше имя может состоять только из латинских символов или чисел<br>", $error_array)) echo "Ваше имя может состоять только из латинских символов или чисел<br>";
                ?>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="reg_lname" placeholder="Ваше фамилия" value="<?php if (isset($_SESSION['reg_lname'])) { echo $_SESSION['reg_lname']; }?>" required>
              <div class="text-danger">
                <?php if (in_array("Ваша фамилия должна быть между 2 и 25 символами<br>", $error_array)) echo "Ваша фамилия должна быть между 2 и 25 символами<br>";
                else if (in_array("Ваша фамилия может состоять только из латинских символов или чисел<br>", $error_array)) echo "Ваша фамилия может состоять только из латинских символов или чисел<br>";
                ?>
              </div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="reg_email" placeholder="Ваш email" value="<?php if (isset($_SESSION['reg_email'])) { echo $_SESSION['reg_email']; }?>" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="reg_email2" placeholder="Повторите email" value="<?php if (isset($_SESSION['reg_email2'])) { echo $_SESSION['reg_email2']; }?>" required>
              <div class="text-danger">
                <?php if (in_array("Email уже используется<br>", $error_array)) echo "Email уже используется<br>";
                else if (in_array("Введите корректный email<br>", $error_array)) echo "Введите корректный email<br>";
                else if (in_array("Адреса электронной почты не совпадают<br>", $error_array)) echo "Адреса электронной почты не совпадают<br>"; ?>
              </div>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="reg_password" placeholder="Пароль" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="reg_password2" placeholder="Повторите пароль" required>
              <div class="text-danger">
                <?php if (in_array("Ваши пароли не совпадают<br>", $error_array)) echo "Ваши пароли не совпадают<br>";
                else if (in_array("Ваш пароль может состоять только из латинских символов или чисел<br>", $error_array)) echo "Ваш пароль может состоять только из латинских символов или чисел<br>";
                else if (in_array("Ваш пароль должен быть между 5 и 30 символами<br>", $error_array)) echo "Ваш пароль должен быть между 5 и 30 символами<br>"; ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" name="register_button">Зарегистрироваться</button>
            <div class="mb-3 mt-3 text-success">
              <?php if (in_array("Вы успешно зарегистрировались", $error_array)) echo "Вы успешно зарегистрировались";?>
            </div>
            <a href="#" id="signIn" class="signIn text-white">Уже есть аккаунт? Войдите здесь!</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.php';

if (isset($_POST['register_button'])) {
  echo '
   <script>
    $(function() {
      $(".first").hide();
      $(".second").show();
    });
   </script>
  ';
}
?>