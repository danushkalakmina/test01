<?php

date_default_timezone_set('Asia/Colombo');

class utils {
    function isWebViewDevice() {
        return (strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== false);
    }
    function getMessageBar($messageText, $type) {

        $messageType = "alert-danger";
        if ($type == "s") {
            $messageType = "alert-success";
        } else if ($type == "e") {
            $messageType = "alert-danger";
        } else if ($type == "w") {
            $messageType = "alert-warning";
        }

        $message = '<div id="gf" class="alert ' . $messageType . ' alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    ' . $messageText . '
                                </div>';

        return $message;
    }

    function getStatusButton($status) {

        $buttonType = "btn-success";
        $statusText = "Active";
        if ($status == "0") {
            $buttonType = "btn-danger";
            $statusText = "Inactive";
        } else if ($status == "1") {
            $buttonType = "btn-success";
            $statusText = "Active";
        }

        $message = '<input type="submit" value="' . $statusText . '" name="changeStatus" class="btn btn-sm ' . $buttonType . '"/>';

        return $message;
    }

    function getWastagePostStatusButton($status) {

        $buttonType = "btn-success";
        $statusText = "Active";
        $buttonStatus = "";
        if ($status == "0") {
            $buttonType = "btn-danger";
            $statusText = "Inactive";
        } else if ($status == "1") {
            $buttonType = "btn-success";
            $statusText = "Active";
        } else if ($status == "2") {
            $buttonType = "btn-warning";
            $statusText = "In Review";
            $buttonStatus = "disabled";
        } else if ($status == "3") {
            $buttonType = "btn-danger";
            $statusText = "Disable By Admin";
            $buttonStatus = "disabled";
        } else if ($status == "4") {
            $buttonType = "btn-success";
            $statusText = "Sold";
            $buttonStatus = "disabled";
        }

        $button = '<button type="submit" name="changeStatus" value="'.$statusText.'" class="btn btn-sm ' . $buttonType . '" '.$buttonStatus.'>'.$statusText.'</button>';

        return $button;
    }
    function getDiscountStatusButton($status) {

        $buttonType = "";
        $statusText = "";
        $buttonStatus = "";
        if ($status == "0") {
            $buttonType = "btn-danger";
            $statusText = "Inactive";
        } else if ($status == "1") {
            $buttonType = "btn-success";
            $statusText = "Active";
        } else if ($status == "2") {
            $buttonType = "btn-danger";
            $statusText = "Disable By Admin";
            $buttonStatus = "disabled";
        }

        $button = '<button type="submit" name="changeStatus" value="'.$statusText.'" class="btn btn-sm ' . $buttonType . '" '.$buttonStatus.'>'.$statusText.'</button>';

        return $button;
    }

    function c_Isset($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST[$param])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if (isset($_GET[$param])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function c_IsNull($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST[$param] != null || $_POST[$param] != "") {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if ($_GET[$param] != null || $_GET[$param] != "") {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function c_IsEmpty($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST[$param])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if (empty($_GET[$param])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function getParam($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $_GET[$param];
        } else {
            return $_POST[$param];
        }
    }
    function getResponseSessionMessage() {
        $message = (isset($_SESSION['response-message'])) ? $_SESSION['response-message'] : '';
//        unset($_SESSION['response-message']);
        return $message;
    }

    function unsetResponseSessionMessage() {
        unset($_SESSION['response-message']);
    }

    function getParamVal($param) {
        $param_value = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $param_value = (isset($_POST[$param])) ? mysqli_real_escape_string($GLOBALS["__mysqli_connect"], $_POST[$param]) : '';
        } else {
            $param_value = (isset($_GET[$param])) ? mysqli_real_escape_string($GLOBALS["__mysqli_connect"], $_GET[$param]) : '';
        }
        return filter_var($param_value, FILTER_SANITIZE_STRING);
    }

    function getValue($obj, $name) {
        return (isset($obj[$name])) ? $obj[$name] : '';
    }
    function getSelectTagValue($obj, $name,$tag_value) {
         $value = (isset($obj[$name])) ? $obj[$name] : '';
         return ($value==$tag_value) ? 'selected' : '';
    }
    function getCheckTagValue($obj, $name,$tag_value) {
         $value = (isset($obj[$name])) ? $obj[$name] : '';

         return ($value==$tag_value) ? 'checked' : '';
    }

}

?>