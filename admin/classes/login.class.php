<?php
date_default_timezone_set('Asia/Colombo');

if(session_id() == '') {
    session_start();
}

class logData
{

    function userVerifiy(string $email, string $password)
    {
        $query = "SELECT `idAdmin`, `name` FROM `admin` where `email` = '" . $email . "' AND `password` = '" . hash('sha256', $password) . "' AND `status`='1' ";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);
        if ($nuwrow > 0) {
            $user_id = '';
            $user_name = '';
            $temp_array = array();
            while ($getValue = mysqli_fetch_array($result)) {
                $temp_array[] = $getValue;
            }
            $user_id = $temp_array[0]["idAdmin"];
            $user_name = $temp_array[0]["name"];
            setcookie('admin-id', base64_encode($user_id), time() + (86400), "/");
            setcookie('user-name', base64_encode($user_name), time() + (86400), "/");
            $_SESSION['admin-id'] = $user_id;
            $_SESSION['user-name'] = $user_name;
            $date = date("Y-m-d h:m:s");
            $browser = mysqli_real_escape_string($GLOBALS["__mysqli_connect"], $_SERVER['HTTP_USER_AGENT']);
            $query = "INSERT INTO admin_log VALUE('0','" . $user_id . "','" . $date . "','" . $browser . "')";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
            $msgPass = 'true';
        } else {
            $cookieName = md5($email);
            $attemed = '';
            if (isset($_COOKIE["'" . $cookieName . "'"])) {
                $attemed = $_COOKIE["'" . $cookieName . "'"];
                if (intval($attemed) > 0) {
                    $attemed = intval($attemed) - 1;
                    setcookie("'" . $cookieName . "'", $attemed, time() + (86400), "/");
                } else {
                    $queryUp = "UPDATE `admin` SET `status` = '2' WHERE `email` = '" . $email . "'";
                    $result = mysqli_query($GLOBALS["__mysqli_connect"], $queryUp);
                }
            } else {
                setcookie("'" . $cookieName . "'", 4, time() + (86400), "/");
            }
            $msgPass = 'false';
        }
        return $msgPass;
    }

    function newUser($userName, $userEmail, $userPassword)
    {
        $query = "INSERT INTO `admin` (`idAdmin`, `name`, `email`, `password`, `status`) 
        VALUES (NULL, '$userName', '$userEmail', '$userPassword', '1')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        if ($result == 1) {

            $msg = "User Added";
        } else {
            $msg = "Data Procesing Error";
        }

        return $msg;


    }


}


?>