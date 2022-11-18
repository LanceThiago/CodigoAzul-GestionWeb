<?php 
    require_once('../DB/DBConnection.php');
    session_start();

    function Edit(array $data) {
        $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $user = stripcslashes(strip_tags($Data['user']));
        $nombreCompleto = stripcslashes(strip_tags($Data['nombreCompleto']));
        $password = htmlspecialchars($Data['password']);
        $Errors = [];

        require_once('./functions/verify.php');
        $userVerify = new userVerify();
        $userExists = $userVerify->checkIfUserExists($user);

        if ($user != $_SESSION['current_session']['user']['Usuario'] && $userExists['status']) {
            $Response['error'] = "Nombre de usuario en uso.";
            return $Response;
        }

        $ID = $_SESSION['current_session']['user']['ID_Usuario'];

        $dbHandler = DbHandler();
        $statement = $dbHandler->prepare("UPDATE `usuarios` SET Usuario = :user, NombreCompleto = :NombreCompleto" . ($password != '' ? ", Password = :Password" : "") . " WHERE ID_Usuario = :ID");
        
        $statement->bindValue(':user', $user, PDO::PARAM_STR);
        $statement->bindValue(':NombreCompleto', $nombreCompleto, PDO::PARAM_STR);
        $statement->bindValue(':ID', $ID, PDO::PARAM_INT);
        if ($password != '') {
            $statement->bindValue(':Password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        }

        $result = $statement->execute();
        if ($result) {
            $response['status'] = true;
            $_SESSION['current_session']['user']['Usuario'] = $user;
            $_SESSION['current_session']['user']['NombreCompleto'] = $nombreCompleto;
            $_SESSION['current_session']['user']['Password'] = password_hash($password, PASSWORD_DEFAULT);
            return true;
        } else {
            return false;
        }
    }
?>