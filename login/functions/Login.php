<?php
  require_once('../DB/DBConnection.php');
  session_start();

  function Login(array $data) {
    $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $Errors = [];
    $user = stripcslashes(strip_tags($Data['user']));
    $Password = htmlspecialchars($Data['password']);

    require_once('./functions/verify.php');
    $userVerify = new userVerify();
    $user_check = $userVerify->checkuser($user);

    if (!$user_check['status']) {
      $Errors['error'] = "Nombre de usuario o contraseña incorrectos.";
      return $Errors;
    } else {
      if (password_verify($Password, $user_check['data']['Password'])) {
        $_SESSION['current_session'] = [
          'status' => 1,
          'user' => $user_check['data'],
          'date_time' => date('Y-m-d H:i:s')
        ];
        header("Location: dashboard.php");
      }

      if (!password_verify($Password, $user_check['data']['Password'])) {
        $Errors['error'] = "Nombre de usuario o contraseña incorrectos.";
        return $Errors;
      }
    }
  }
?>
