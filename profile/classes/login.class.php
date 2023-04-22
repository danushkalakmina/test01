<?php
date_default_timezone_set('Asia/Colombo');
session_start();

class logData{

    function userVerifiy(string $email ,string $password ){



        $query = "SELECT `iduser`,name FROM `user` where `email` = '". $email ."' AND `password` = '". hash('sha256',$password) ."' AND `status`='1' ";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);

        if($nuwrow>0){

            $compy_id = '';
            $user_id = '';
            $user_name = '';

            $temp_array = array();
            while ($getValue = mysqli_fetch_array($result)) {
                $temp_array[] = $getValue;
            }
            $user_id = $temp_array[0]["iduser"];
            $user_name = $temp_array[0]["name"];

            $query = "SELECT comReg.idcompany_reg FROM `company_reg` AS comReg INNER JOIN `user` usrLog ON usrLog.idcompany_reg = comReg.idcompany_reg WHERE usrLog.email= '". $email ."'";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

            while ($row = mysqli_fetch_row($result)) {
                $compy_id = $row[0];
            }

            setcookie('company-id',  base64_encode($compy_id) , time() + (86400), "/");
            setcookie('user-id', base64_encode($user_id) , time() + (86400), "/");
            setcookie('user-name', base64_encode($user_name) , time() + (86400), "/");

            $date = date("Y-m-d h:m:s");
            $browser = mysqli_real_escape_string($GLOBALS["__mysqli_connect"], $_SERVER['HTTP_USER_AGENT']);
            $query = "INSERT INTO user_log VALUE('0','" . $user_id . "','" . $date . "','" . $browser . "')";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

            $msgPass = 'true';


        }else{

            $cookieName = md5($email);
            $attemed = '';

            

            if (isset($_COOKIE["'".$cookieName."'"])) {

                $attemed = $_COOKIE["'".$cookieName."'"];

                if(intval($attemed) > 0 ){
                    $attemed = intval($attemed) - 1;
                    setcookie("'".$cookieName."'", $attemed, time() + (86400), "/");
                }else{

                    $queryUp = "UPDATE `user` SET `status` = '2' WHERE `email` = '" .$email . "'";
                    $result = mysqli_query($GLOBALS["__mysqli_connect"], $queryUp);

                }
                
            }else{
                setcookie("'".$cookieName."'", 4 , time() + (86400), "/");
            }

     
            
            

            $msgPass = 'false'; 
            

        }
    
        return $msgPass;
    
    
    
        
    }

    function userVerifyMobile(string $email ,string $password ){
        $query = "SELECT iduser,idcompany_reg,name,email FROM user where email = '". $email ."' AND password = '". hash('sha256',$password) ."' AND `status`='1' ";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        if (count($temp_array) == 1) {
            $logData = array(
                'is_success' => 'true',
                'user_id' => $temp_array[0]["iduser"],
                'company_id' => $temp_array[0]["idcompany_reg"],
                'name' => $temp_array[0]["name"],
                'email' => $temp_array[0]["email"]
            );
            $date = date("Y-m-d h:m:s");
            $browser = mysqli_real_escape_string($GLOBALS["__mysqli_connect"], $_SERVER['HTTP_USER_AGENT']);
            $query = "INSERT INTO user_log VALUE('0','" . $temp_array[0]["iduser"] . "','" . $date . "','" . $browser . "')";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        }else{
            $logData = array('is_success' => 'false','user_id' => '' ,'company_id' => '' ,'name' => '' ,'email' => '');
        }
        return $logData;
    }


    function userTempPw($email){

        $email = filter_var($email,FILTER_SANITIZE_EMAIL);

        $query = "SELECT `iduser` FROM `user` WHERE `email` = '$email'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow>0) {
            
            try{
            
            require '../PHPMailer/src/Exception.php';
            require '../PHPMailer/src/PHPMailer.php';
            require '../PHPMailer/src/SMTP.php';
            
            $mail = new PHPMailer(true);

            $lSimple = ['a','b','c','d','e','f','g'.'h','i','j'];
            $lCapital = ['A','B','C','D','E','F','G'.'H','I','J'];
            $nList = [0,1,2,3,4,5,6,7,8,9];
            $chapList = ['!','#','@','$','%','&','+','_','/','-'];

            $tempPassword = '';

            do {

                $tNum = rand(0,4);
                $cNum = rand(0,9);

                switch ($tNum) {
                    case 0:
                        $tempNewChap = $lSimple[$cNum];
                        break;
                    case 1:
                        $tempNewChap = $lCapital[$cNum];
                        break;
                    case 2:
                        $tempNewChap = $nList[$cNum];
                        break;
                    case 3:
                        $tempNewChap = $chapList[$cNum];
                        break;
                    default:
                        $tempNewChap = $lSimple[0];
                        break;
                }
                

                if ($tempPassword == '') {
                    $tempPassword =  $tempNewChap;
                }else{

                    $tempPassword = $tempPassword . $tempNewChap;

                }
                
            } while (strlen($tempPassword) <= 10);

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;     
            $mail->SMTPDebug = 0;   
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'wasteyproject@gmail.com';                     
            $mail->Password   = 'w@st3ypr0j3ct';                               
            $mail->SMTPSecure = 'tls';            
            $mail->Port       = 587;                                   

            $mail->setFrom('wasteyproject@gmail.com' , 'Wastey Access');
            $mail->addAddress($email);              
            $mail->addReplyTo('wasteyproject@gmail.com', 'Information');
            $mail->isHTML(true);                                  
            $mail->Subject = 'System Access';
            $mail->Body    = 'Your Password is  <b>' . $tempPassword .'</b>';
            $mail->send();
            $res = "email send";
            }catch (Exception $e){
                
                $res = "email not send";
            }

            if($res == 'email send'){


                mysqli_free_result($result);
                mysqli_next_result($GLOBALS["__mysqli_connect"]);
                $tempPassword = hash('sha256', $tempPassword);

                $query = "UPDATE `user` SET `password` = '$tempPassword' WHERE `email` = '$email'";
                $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

                if($result == 1){
                    return "pass";
                }else{
                    return "passwordissue";
                }


            
                
            }else {
            
            return "mailissue";
                }
            

        }else {
            
            return "fail";
        }


        
    }



}


?>