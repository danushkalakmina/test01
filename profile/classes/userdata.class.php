<?php
date_default_timezone_set('Asia/Colombo');

class userdata{

    function call_UserData($userID){


        $qurry = "CALL get_user_info('$userID')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $numRow = mysqli_num_rows($result);
        $usrDataPass = array();

        if($numRow>0){

            while ($getValue = mysqli_fetch_array($result)) {
                $usrDataPass[] = $getValue;
            }
            
        }

        return $usrDataPass;





       
    }


    function typeList(){


        $qurry = "SELECT * FROM `user_type` ";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $numRow = mysqli_num_rows($result);

        if($numRow>0){

            while ($getValue = mysqli_fetch_array($result)) {
                $typeListPass[] = array('typeId'=>$getValue['iduser_type'],'typeName'=>$getValue['type']);
            }
            
        }

        return $typeListPass;


    }

    function cityAll($districName){

        $qurry = "SELECT city.idcity AS cityID ,city.name AS cityName FROM `district` as district INNER JOIN `city` AS city ON city.iddistrict =  district.iddistrict WHERE district.name LIKE '%$districName%'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $numRow = mysqli_num_rows($result);

        if($numRow>0){

            while ($getValue = mysqli_fetch_array($result)) {
                $cityListPass[] = array('cityId'=>$getValue['cityID'],'cityName'=>$getValue['cityName']);
            }
            
        }

        return $cityListPass;


    }

    function districAll(){


        $qurry = "SELECT * FROM `district`";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $numRow = mysqli_num_rows($result);

        if($numRow>0){

            while ($getValue = mysqli_fetch_array($result)) {
                $districListPass[] = array('districId'=>$getValue['iddistrict'],'districName'=>$getValue['name']);
            }
            
        }

        return $districListPass;



    }

    function userUpdate($userName,$userEmail,$userContact,$companyType,$companyName,$companyAddress,$distric,$city){


        $userID = base64_decode($_COOKIE['user-id']);
        $companyID = base64_decode($_COOKIE['company-id']);
        $today = date("Y-m-d H:i:s");
        $proof = $_COOKIE['prof_image'];

        $qurry = "UPDATE `user` AS usr , `company_reg` AS company 
        SET usr.iduser_type = '$companyType' , 
        usr.name = '$userName',
        usr.email = '$userEmail',
        usr.contact_no = '$userContact',
        usr.updated_at = '$today',
        usr.status='2',
        company.idcity='$city',
        company.name='$companyName',
        company.address='$companyAddress',
        company.proof_url='$proof',
        company.updated_at='$today' 
        WHERE usr.iduser = '$userID' AND  company.idcompany_reg= usr.idcompany_reg " ;
        
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);

        if ($result == '1') {

            return 'Updated';

        }else{

            return 'NotUpdated';
        }


    }






}
?>