<?php
    class userVerify {
        function checkUser(string $user) : array {
            $dbHandler = DbHandler();
            $statement = $dbHandler->prepare("SELECT * FROM `usuarios` WHERE `Usuario` = :user AND `Estado` = 1");
            $statement->bindValue(':user', $user, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
    
            if (empty($result)) {
                $response['status'] = false;
                $response['data'] = [];
                return $response;
            }
    
            $response['status'] = true;
            $response['data'] = $result;
            return $response;
        }

        function checkIfUserExists(string $user) : array {
            $dbHandler = DbHandler();
            $statement = $dbHandler->prepare("SELECT COUNT(ID_Usuario) AS 'count' FROM `usuarios` WHERE `Usuario` = :user");
            $statement->bindValue(':user', $user, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
    
            if ($result['count'] == 0) {
                $response['status'] = false;
                return $response;
            }
    
            $response['status'] = true;
            return $response;
        }
    }
?>