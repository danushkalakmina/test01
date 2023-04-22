<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

date_default_timezone_set('Asia/Colombo');

class datacall
{

    function districtList()
    {
        $query = 'SELECT * FROM `district` ORDER BY `name` ASC';
        $stmt = $this->connect()->query($query);
        $numCount = $stmt->rowCount();

        if ($numCount > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $disList[] = array('disId' => $row['iddistrict'],
                    'disNam' => $row['name']
                );
            }
        } else {

            $disList[] = array('disId' => "noData", 'disNam' => "noData");
        }

        return $disList;
    }

    function cityList($districtId)
    {
        $query = 'SELECT * FROM `city` WHERE `iddistrict`= ' . $districtId . ' ORDER BY `name` ASC';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $numRow = mysqli_num_rows($result);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if ($numRow > 0) {
            foreach ($temp_array as $cityLists) {

                $cityList [] = array('cityId' => $cityLists['idcity'], 'cityName' => $cityLists['name']);
            }
        } else {
            $cityList [] = array('cityId' => 'NoData', 'cityName' => 'NoData');
        }
        return $cityList;
    }

    function checkDiscount($postID, $districtCode, $subTotal, $delivery_price)
    {
        $query = "SELECT percentage FROM discount WHERE idwastage='" . $postID . "' AND discount_code='" . $districtCode . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $discount = "0";
        $discountValue = "0.00";
        $sTotal = $subTotal;
        $discountStatus = "0";
        $total = "0";
//        echo $query;
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            $discountStatus = "1";
            $discount = $temp_array[0]["percentage"];
            $discountValue = ($subTotal * $discount) / 100;
            $sTotal = ($subTotal - $discountValue);
        }
        $total = $sTotal + $delivery_price;

        return array(
            'discountPercentage' => $discount,
            'discountValue' => $discountValue,
            'sub_total' => $sTotal,
            'total' => $total,
            'discountStatus' => $discountStatus
        );
    }

    function getPostedCount($companyID)
    {
        $query = "SELECT
	SUM(wastage.qty) as totalQty, 
	MONTH(wastage.date) as month,
	YEAR(wastage.date) as year
FROM
	wastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser 
	WHERE `user`.idcompany_reg = '" . $companyID . "'
GROUP BY YEAR(wastage.date), MONTH(wastage.date)";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $temp_label_array = array();
        $temp_data_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_label_array[] = $getValue["month"] . ' / ' . $getValue["year"];
            $temp_data_array[] = $getValue["totalQty"];
        }

        $query = "SELECT
	SUM(wastage.qty) AS totalQty, 
	wastage.unit
FROM
	wastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser
	WHERE `user`.idcompany_reg = '" . $companyID . "' GROUP BY wastage.unit";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $temp_pie_chart_label_array = array();
        $temp_pie_chart_data_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_pie_chart_label_array[] = strtoupper($getValue["unit"]);
            $temp_pie_chart_data_array[] = $getValue["totalQty"];
        }


        return array(
            'label_array' => $temp_label_array,
            'data_array' => $temp_data_array,
            'pie_chart_label_array' => $temp_pie_chart_label_array,
            'pie_chart_data_array' => $temp_pie_chart_data_array
        );
    }

    function checkBidDetails($bidding_no)
    {
        $query = "SELECT
	bidding_wastage.price,
	bidding_wastage.remark,
	wastage.qty,
	wastage.title,
	wastage.is_delivery,
	wastage.delivery_price
FROM
	bidding_wastage
	INNER JOIN
	wastage
	ON
		bidding_wastage.idwastage = wastage.idwastage WHERE bidding_wastage.id_bidding='" . $bidding_no . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $qty = "0";
        $bid_price = "0.00";
        $sub_total = "0.00";
        $delivery_price = "0.00";
        $total = "0.00";
        $bidStatus = "0";
        $is_delivery = "0";
//        echo $query;
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        if (count($temp_array) == 1) {
            $qty = $temp_array[0]["qty"];
            $bid_price = $temp_array[0]["price"];
            $sub_total = $temp_array[0]["price"];
            $is_delivery = $temp_array[0]["is_delivery"];
            $delivery_price = $temp_array[0]["delivery_price"];
            $total = ($sub_total + $delivery_price);
            $bidStatus = "1";
        }

        return array(
            'qty' => $qty,
            'bid_price' => $bid_price,
            'sub_total' => $sub_total,
            'total' => $total,
            'bidStatus' => $bidStatus,
            'is_delivery' => $is_delivery,
            'delivery_price' => $delivery_price
        );

    }

    function searchPosts()
    {

        $query = "SELECT * FROM wastage ";

//        return $query;
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);;
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadCompanyType()
    {
        $query = 'SELECT * FROM `user_type` WHERE status="1" ORDER BY `priority` ASC';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadDistrict()
    {
        $query = 'SELECT * FROM `district` ORDER BY `name` ASC';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadWastagePosts($companyID, $page_no, $limit)
    {

        $offset = (($page_no - 1) * $limit);
        $query = "SELECT wastage.idwastage,wastage.image, wastage.date, wastage.title, wastage.description, wastage.qty,wastage.balance_qty, wastage.unit, wastage.total_price, wastage.booked_by, wastage.waste_type, wastage.isbidding, wastage.`status` FROM wastage INNER JOIN user ON wastage.iduser = user.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg where company_reg.idcompany_reg='" . $companyID . "' ORDER BY date DESC LIMIT " . $limit . " OFFSET " . $offset;
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function getOrderCount($post_code, $company_id)
    {
        $query = "SELECT
	COUNT(invoice.idinvoice) AS orderCount
FROM
	invoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE user.idcompany_reg='" . $company_id . "' AND wastage.idwastage='" . $post_code . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            return $temp_array[0]["orderCount"];
        }
        return "0";
    }

    function getActiveBidCount($company_id)
    {
        $query = "SELECT COUNT(bidding_wastage.id_bidding) AS bidCount FROM bidding_wastage INNER JOIN wastage ON bidding_wastage.idwastage = wastage.idwastage INNER JOIN `user` ON wastage.iduser = `user`.iduser 
                                                       WHERE user.idcompany_reg='" . $company_id . "' AND wastage.status=1";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            return $temp_array[0]["bidCount"];
        }
        return "0";
    }

    function getActiveOrderCount($company_id)
    {
        $query = "SELECT
	invoice.idinvoice,
	delivery_tracker.status_name
FROM
	invoice
	INNER JOIN
	delivery_tracker
	ON 
		invoice.idinvoice = delivery_tracker.idinvoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE user.idcompany_reg='" . $company_id . "'";
//        echo $query;
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[$row['idinvoice']] = $row;
        }
        $count = 0;
        foreach ($temp_array as $result) {
            if ($result["status_name"] != "Delivered") {
                $count += 1;
            }
        }

        return $count;
    }

    function getTotalSales($company_id, $type)
    {
        if ($type == "monthly") {
            $query = "SELECT
	SUM(invoice.total) as itemCount
FROM
	invoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		invoice.iduser = `user`.iduser AND
		wastage.iduser = `user`.iduser
  WHERE `user`.idcompany_reg='" . $company_id . "' AND MONTH(invoice.date) = MONTH(CURRENT_DATE())
AND YEAR(invoice.date) = YEAR(CURRENT_DATE())";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
            $temp_array = array();
            while ($getValue = mysqli_fetch_array($result)) {
                $temp_array[] = $getValue;
            }

            if (count($temp_array) == 1) {
                return $temp_array[0]["itemCount"];
            }
        } else if ($type == "yearly") {

            $query = "SELECT
	SUM(invoice.total) as itemCount
FROM
	invoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		invoice.iduser = `user`.iduser AND
		wastage.iduser = `user`.iduser
  WHERE `user`.idcompany_reg='" . $company_id . "'
  AND YEAR(invoice.date) = YEAR(CURRENT_DATE())";
            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
            $temp_array = array();
            while ($getValue = mysqli_fetch_array($result)) {
                $temp_array[] = $getValue;
            }

            if (count($temp_array) == 1) {
                return $temp_array[0]["itemCount"];
            }
        }

        return "0";
    }

    function getBidCount($post_code, $company_id)
    {

        $query = "SELECT COUNT(id_bidding) AS bidingCount FROM
	bidding_wastage
	INNER JOIN
	wastage
	ON 
		bidding_wastage.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE wastage.idwastage='" . $post_code . "' AND user.idcompany_reg='" . $company_id . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            return $temp_array[0]["bidingCount"];
        }
        return "0";
    }

    function getWastagePostsPageCount($companyID, $limit)
    {

        $query = "SELECT wastage.idwastage,wastage.image, wastage.date, wastage.title, wastage.description, wastage.qty, wastage.unit, wastage.total_price, wastage.booked_by, wastage.waste_type, wastage.`status` FROM wastage INNER JOIN user ON wastage.iduser = user.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg where company_reg.idcompany_reg='" . $companyID . "' ORDER BY date DESC";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $number_of_result = mysqli_num_rows($result);
        $number_of_page = ceil($number_of_result / $limit);

        return $number_of_page;
    }

    function getNewCompanyCode()
    {
        $query = 'SELECT *  FROM `company_reg` ORDER BY `idcompany_reg` DESC LIMIT 1';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $cmpCode = $row[0];
            }
            $cmpCode = substr($cmpCode, -4);
            $codegen = intval($cmpCode) + 1;
            switch (strlen(strval($codegen))) {
                case '1':
                    $codegen = '000' . $codegen;
                    break;
                case '2':
                    $codegen = '00' . $codegen;
                    break;
                case '3':
                    $codegen = '0' . $codegen;
                    break;
                case '4':
                    $codegen = $codegen;
                    break;
                default:
                    $codegen = $codegen;
            }
        } else {
            $codegen = '0001';
        }

        $nextCmpCode = 'CM' . date("ymd") . $codegen;
        return $nextCmpCode;
    }

    function getNewUserCode()
    {
        $query = 'SELECT *  FROM `user` ORDER BY `iduser` DESC LIMIT 1';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);
        if ($nuwrow > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $cstCode = $row[0];
            }
            $cstCode = substr($cstCode, -4);
            $codeCusgen = intval($cstCode) + 1;
            switch (strlen(strval($codeCusgen))) {
                case '1':
                    $codeCusgen = '000' . $codeCusgen;
                    break;
                case '2':
                    $codeCusgen = '00' . $codeCusgen;
                    break;
                case '3':
                    $codeCusgen = '0' . $codeCusgen;
                    break;
                case '4':
                    $codeCusgen = $codeCusgen;
                    break;
                default:
                    $codeCusgen = $codeCusgen;
            }
        } else {
            $codeCusgen = '0001';
        }

        $nextUsrCode = 'U' . date("ymd") . $codeCusgen;
        return $nextUsrCode;
    }

    function getNewWastagePostCode()
    {
        $query = 'SELECT *  FROM `wastage` ORDER BY `idwastage` DESC LIMIT 1';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);
        if ($nuwrow > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $cstCode = $row[0];
            }
            $cstCode = substr($cstCode, -4);
            $codeCusgen = intval($cstCode) + 1;
            switch (strlen(strval($codeCusgen))) {
                case '1':
                    $codeCusgen = '000' . $codeCusgen;
                    break;
                case '2':
                    $codeCusgen = '00' . $codeCusgen;
                    break;
                case '3':
                    $codeCusgen = '0' . $codeCusgen;
                    break;
                case '4':
                    $codeCusgen = $codeCusgen;
                    break;
                default:
                    $codeCusgen = $codeCusgen;
            }
        } else {
            $codeCusgen = '0001';
        }

        $nextUsrCode = 'W' . date("ymd") . $codeCusgen;
        return $nextUsrCode;
    }

    function getNewInvoiceID()
    {
        $query = 'SELECT *  FROM `invoice` ORDER BY `idinvoice` DESC LIMIT 1';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);
        if ($nuwrow > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $cstCode = $row[0];
            }
            $cstCode = substr($cstCode, -4);
            $codeCusgen = intval($cstCode) + 1;
            switch (strlen(strval($codeCusgen))) {
                case '1':
                    $codeCusgen = '000' . $codeCusgen;
                    break;
                case '2':
                    $codeCusgen = '00' . $codeCusgen;
                    break;
                case '3':
                    $codeCusgen = '0' . $codeCusgen;
                    break;
                case '4':
                    $codeCusgen = $codeCusgen;
                    break;
                default:
                    $codeCusgen = $codeCusgen;
            }
        } else {
            $codeCusgen = '0001';
        }

        $nextUsrCode = 'IN' . date("ymd") . $codeCusgen;
        return $nextUsrCode;
    }

    function getNewID($table_name, $table_id, $prefix)
    {
        $query = 'SELECT *  FROM ' . $table_name . ' ORDER BY `' . $table_id . '` DESC LIMIT 1';
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $nuwrow = mysqli_num_rows($result);
        if ($nuwrow > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $cstCode = $row[0];
            }
            $cstCode = substr($cstCode, -4);
            $codeCusgen = intval($cstCode) + 1;
            switch (strlen(strval($codeCusgen))) {
                case '1':
                    $codeCusgen = '000' . $codeCusgen;
                    break;
                case '2':
                    $codeCusgen = '00' . $codeCusgen;
                    break;
                case '3':
                    $codeCusgen = '0' . $codeCusgen;
                    break;
                case '4':
                    $codeCusgen = $codeCusgen;
                    break;
                default:
                    $codeCusgen = $codeCusgen;
            }
        } else {
            $codeCusgen = '0001';
        }

        $nextUsrCode = $prefix . date("ymd") . $codeCusgen;
        return $nextUsrCode;
    }

    function resistorUses($type, $cmpName, $city, $cmpAddress, $cntName, $cntNumb, $usrEmail, $usrPass, $parkImageSave, $nextCompanyCode, $nextUserCode)
    {
        $usrDpass = hash('sha256', $usrPass);
        $dateee = date("Y-m-d h:m:s");
        $query = "INSERT INTO `company_reg` (`idcompany_reg`, `idcity`, `name`, `address`, `contact_pname`, `contact_no`, `proof_url`, `created_at`, `updated_at`) 
    VALUES ('$nextCompanyCode', '$city', '$cmpName','$cmpAddress' ,'$cntName' ,'$cntNumb' , '$parkImageSave','$dateee' ,'$dateee' )";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $query = "INSERT INTO `user` (`iduser`, `iduser_type`, `idcompany_reg`, `name`, `email`, `password`, `contact_no`, `created_at`, `updated_at`, `status`) 
    VALUES ('$nextUserCode', '$type', '$nextCompanyCode', '$cntName', '$usrEmail', '$usrDpass', '$cntNumb', '$dateee', '$dateee', '1')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
    }

    function makePayment($user_id, $post_code, $process_type, $first_name, $last_name, $email, $billing_address, $billing_note, $unit_price, $qty, $sub_total, $discountPercentage, $discountValue, $delivery_price, $delivery_address, $total)
    {
        $utils = new utils();
        if (empty($first_name)) {
            return $utils->getMessageBar("First name can't be empty.", "e");
        }
        if (empty($last_name)) {
            return $utils->getMessageBar("Last name can't be empty.", "e");
        }
        if (empty($email)) {
            return $utils->getMessageBar("Email address can't be empty.", "e");
        }
        if (empty($billing_address)) {
            return $utils->getMessageBar("Billing address can't be empty.", "e");
        }

        $invoice_id = $this->getNewInvoiceID();
        $date_time = date("Y-m-d h:m:s");

        $invStatus = (!empty($delivery_address)) ? "2" : "1";

        $query = "INSERT INTO invoice VALUE('" . $invoice_id . "','" . $date_time . "','" . $process_type . "','" . $post_code . "','" . $user_id . "','" . $first_name . "','" . $last_name . "','" . $email . "','" . $billing_address . "','" . $billing_note . "','" . $delivery_address . "','" . $unit_price . "','" . $qty . "','" . $sub_total . "','" . $delivery_price . "','" . $discountPercentage . "','" . $discountValue . "','" . $total . "','" . $invStatus . "')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $query = "UPDATE wastage SET wastage.balance_qty=wastage.balance_qty-" . $qty . ",wastage.booked_by='" . $user_id . "',wastage.status='4' where wastage.idwastage='" . $post_code . "'";
        $result_update_wastage = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $query = "INSERT INTO delivery_tracker VALUE(0,'" . $invoice_id . "','" . $date_time . "','Order Request Send To Seller')";
        $result_delivery_tracker = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        if ($result && $result_update_wastage && $result_delivery_tracker) {
            return $invoice_id;
        } else {
            return "";
        }
    }

    function updateDeliveryTracker($idinvoice, $status_name)
    {

        $utils = new utils();
        if ($status_name == "Delivered") {
            return $utils->getMessageBar("Delivery tracker status update unsuccessful", "e");
        }

        $date_time = date("Y-m-d h:m:s");
        $nextStatus = "";
        if ($status_name == "Order Request Send To Seller") {
            $nextStatus = "Request Processing";
        } else if ($status_name == "Request Processing") {
            $nextStatus = "Packaging";
        } else if ($status_name == "Packaging") {
            $nextStatus = "Ready to Delivery";
        } else if ($status_name == "Ready to Delivery") {
            $nextStatus = "Delivery On-The-Way";
        } else if ($status_name == "Delivery On-The-Way") {
            $nextStatus = "Delivered";
        }

        if ($status_name == "Delivered") {
            $query = "UPDATE invoice SET status='1' where idinvoice='" . $idinvoice . "'";
            $result_invoice = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        }


        $query = "INSERT INTO delivery_tracker VALUE(0,'" . $idinvoice . "','" . $date_time . "','" . $nextStatus . "')";
        $result_delivery_tracker = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        if ($result_delivery_tracker) {
            return $utils->getMessageBar("Delivery tracker status update successfully", "s");
        } else {
            return $utils->getMessageBar("Delivery tracker status update unsuccessful", "e");
        }
    }

    function createDiscount($post_code, $discount_percentage)
    {
        $utils = new utils();
        if (empty($post_code)) {
            return $utils->getMessageBar("Couldn't found post details", "e");
        }
        if (empty($discount_percentage)) {
            return $utils->getMessageBar("Waste percentage can't be empty.", "e");
        }

        $nextCouponID = $this->getNewID("discount", "discount_code", "D");
        $query = "INSERT INTO discount VALUE('" . $nextCouponID . "','" . $post_code . "','" . $discount_percentage . "','1')";
        $result_discount = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $utils = new utils();
        if ($result_discount) {
            return $utils->getMessageBar("Discount coupon created (" . $nextCouponID . ")", "s");
        } else {
            return $utils->getMessageBar("Discount coupon not created", "e");
        }
    }

    function createPost($user_id, $post_title, $post_description, $waste_type, $total_qty, $units, $total_price, $image_url, $is_negotiate, $is_biding, $is_partially_allowed, $min_partial_qty, $partial_unit_price, $buyersArray, $contact_no, $city, $pickup_address, $is_deliver_allowed, $delivery_cost)
    {
        $utils = new utils();
        if (empty($post_title)) {
            return $utils->getMessageBar("Post title can't be empty.", "e");
        }
        if (empty($post_description)) {
            return $utils->getMessageBar("Post description can't be empty.", "e");
        }
        if (empty($waste_type)) {
            return $utils->getMessageBar("Waste type can't be empty.", "e");
        }
        if (empty($total_qty)) {
            return $utils->getMessageBar("Total QTY can't be empty.", "e");
        }
        if (empty($units)) {
            return $utils->getMessageBar("Units can't be empty.", "e");
        }
        if (empty($total_price)) {
            return $utils->getMessageBar("Wholesale price can't be empty.", "e");
        }
        if (empty($image_url)) {
            return $utils->getMessageBar("Image can't be empty.", "e");
        }
        if (count($buyersArray) == 0) {
            return $utils->getMessageBar("Please select preferred buyers at least one.", "e");
        }
        if (empty($contact_no)) {
            return $utils->getMessageBar("Contact no can't be empty.", "e");
        }
        if (empty($pickup_address)) {
            return $utils->getMessageBar("Pick-Up address can't be empty.", "e");
        }
        $min_partial_qty = (!empty($min_partial_qty)) ? $min_partial_qty : 0;
        $partial_unit_price = (!empty($partial_unit_price)) ? $partial_unit_price : 0;
        $delivery_cost = (!empty($delivery_cost)) ? $delivery_cost : 0;
        $date_time = date("Y-m-d h:m:s");
        $wastage_post_id = $this->getNewWastagePostCode();
        $query = "INSERT INTO wastage VALUE('" . $wastage_post_id . "','" . $city . "','" . $user_id . "','" . $image_url . "','" . $date_time . "','" . $post_title . "','" . $post_description . "','" . $total_qty . "','" . $total_qty . "','" . $units . "','" . $total_price . "','" . $is_negotiate . "','" . $is_biding . "','" . $contact_no . "','','" . $waste_type . "','" . $is_partially_allowed . "','" . $min_partial_qty . "','" . $partial_unit_price . "','" . $pickup_address . "','" . $is_deliver_allowed . "','" . $delivery_cost . "','2')";
        $result_wastage = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        foreach ($buyersArray as $result) {
            if (!empty($result["check"])) {
                $query = "INSERT INTO preferred_user_type VALUE(0,'" . $result["user_type"] . "','" . $wastage_post_id . "','" . $result["time"] . "','" . $result["discount"] . "')";
                $result_user_type = mysqli_query($GLOBALS["__mysqli_connect"], $query);
            }
        }
        $utils = new utils();
        if ($result_wastage && $result_user_type) {
            return $utils->getMessageBar("Post saved successfully", "s");
        } else {
            return $utils->getMessageBar("Post save unsuccessful", "e");
        }
    }

    function updateWastagePost($companyID, $postID, $post_title, $post_description, $waste_type, $total_qty, $units, $total_price, $parkImageSave, $is_negotiate, $is_biding, $is_partially_allowed, $min_partial_qty, $partial_unit_price, $buyersArray, $contact_no, $city, $pickup_address, $is_deliver_allowed, $delivery_cost)
    {
        $utils = new utils();
        if (empty($post_title)) {
            return $utils->getMessageBar("Post title can't be empty.", "e");
        }
        if (empty($post_description)) {
            return $utils->getMessageBar("Post description can't be empty.", "e");
        }
        if (empty($waste_type)) {
            return $utils->getMessageBar("Waste type can't be empty.", "e");
        }
        if (empty($total_qty)) {
            return $utils->getMessageBar("Total QTY can't be empty.", "e");
        }
        if (empty($units)) {
            return $utils->getMessageBar("Units can't be empty.", "e");
        }
        if (empty($total_price)) {
            return $utils->getMessageBar("Wholesale price can't be empty.", "e");
        }
        if (count($buyersArray) == 0) {
            return $utils->getMessageBar("Please select preferred buyers at least one.", "e");
        }
        if (empty($contact_no)) {
            return $utils->getMessageBar("Contact no can't be empty.", "e");
        }
        if (empty($pickup_address)) {
            return $utils->getMessageBar("Pick-Up address can't be empty.", "e");
        }
        if (!empty($parkImageSave)) {
            $query = "UPDATE wastage INNER JOIN user ON wastage.iduser = user.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg SET wastage.idcity='" . $city . "',wastage.title='" . $post_title . "',wastage.image='" . $parkImageSave . "',wastage.description='" . $post_description . "',wastage.qty='" . $total_qty . "',wastage.balance_qty='" . $total_qty . "',wastage.unit='" . $units . "',wastage.total_price='" . $total_price . "',wastage.isnegotiable='" . $is_negotiate . "',wastage.isbidding='" . $is_biding . "',wastage.contact_no='" . $contact_no . "',wastage.waste_type='" . $waste_type . "',wastage.isseperate='" . $is_partially_allowed . "',wastage.seperate_min_qty='" . $min_partial_qty . "',wastage.unit_price='" . $partial_unit_price . "',wastage.pick_up_address='" . $pickup_address . "',wastage.is_delivery='" . $is_deliver_allowed . "',wastage.delivery_price='" . $delivery_cost . "' where company_reg.idcompany_reg='" . $companyID . "' AND wastage.idwastage='" . $postID . "'";
        } else {
            $query = "UPDATE wastage INNER JOIN user ON wastage.iduser = user.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg SET wastage.idcity='" . $city . "',wastage.title='" . $post_title . "',wastage.description='" . $post_description . "',wastage.qty='" . $total_qty . "',wastage.balance_qty='" . $total_qty . "',wastage.unit='" . $units . "',wastage.total_price='" . $total_price . "',wastage.isnegotiable='" . $is_negotiate . "',wastage.isbidding='" . $is_biding . "',wastage.contact_no='" . $contact_no . "',wastage.waste_type='" . $waste_type . "',wastage.isseperate='" . $is_partially_allowed . "',wastage.seperate_min_qty='" . $min_partial_qty . "',wastage.unit_price='" . $partial_unit_price . "',wastage.pick_up_address='" . $pickup_address . "',wastage.is_delivery='" . $is_deliver_allowed . "',wastage.delivery_price='" . $delivery_cost . "' where company_reg.idcompany_reg='" . $companyID . "' AND wastage.idwastage='" . $postID . "'";
        }
        $result_wastage = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $query = "DELETE FROM preferred_user_type WHERE idwastage='" . $postID . "'";
        $result_user_type_delete = mysqli_query($GLOBALS["__mysqli_connect"], $query);


        foreach ($buyersArray as $result) {
            if (!empty($result["check"])) {
                $query = "INSERT INTO preferred_user_type VALUE(0,'" . $result["user_type"] . "','" . $postID . "','" . $result["time"] . "','" . $result["discount"] . "')";
                $result_user_type = mysqli_query($GLOBALS["__mysqli_connect"], $query);
            }
        }

        if ($result_wastage && $result_user_type) {
            return $utils->getMessageBar("Post successfully updated", "s");
        } else {
            return $utils->getMessageBar("Post update unsuccessful", "e");
        }
    }

    function updatePostStatus($post_code, $change_status, $company_id)
    {
        $utils = new utils();
        if ($change_status == "In Review") {
            return $utils->getMessageBar("Your " . $post_code . " post in review can't change post status", "e");
        }
        $status = ($change_status == "Active") ? '0' : '1';
        $query = "UPDATE wastage INNER JOIN user ON wastage.iduser = `user`.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg  SET wastage.status='" . $status . "' WHERE wastage.idwastage='" . $post_code . "' AND company_reg.idcompany_reg='" . $company_id . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        if ($result) {
            $newStatus = ($status == '0') ? 'active' : 'inactive';
            return $utils->getMessageBar("Post " . $post_code . " is " . $newStatus, "s");
        } else {
            return $utils->getMessageBar("Unable to change post status", "e");
        }
    }

    function updatePostStatusNo($post_code, $change_status, $company_id)
    {
        $utils = new utils();
        if ($change_status == "2") {
            return $utils->getMessageBar("Your " . $post_code . " post in review can't change post status", "e");
        } else if ($change_status == "3") {
            return $utils->getMessageBar("Your " . $post_code . " post disabled by admin", "e");
        }

        $query = "UPDATE wastage INNER JOIN user ON wastage.iduser = `user`.iduser INNER JOIN company_reg ON user.idcompany_reg = company_reg.idcompany_reg  SET wastage.status='" . $change_status . "' WHERE wastage.idwastage='" . $post_code . "' AND company_reg.idcompany_reg='" . $company_id . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        if ($result) {
            $newStatus = "";
            if ($change_status == "0") {
                $newStatus = "inactive";
            } else if ($change_status == "1") {
                $newStatus = "active";
            } else if ($change_status == "4") {
                $newStatus = "sold";
            }
            return $utils->getMessageBar("Post " . $post_code . " is " . $newStatus, "s");
        } else {
            return $utils->getMessageBar("Unable to change post status", "e");
        }
    }

    function createBid($post_code, $bidding_price, $bidding_message, $user_id)
    {
        $utils = new utils();
        $date_time = date("Y-m-d h:m:s");
        $next_ID = $this->getNewID("bidding_wastage", "id_bidding", "B");

        $query = "INSERT INTO bidding_wastage VALUE('" . $next_ID . "','" . $user_id . "','" . $post_code . "','" . $bidding_price . "','" . $bidding_message . "','" . $date_time . "','" . $date_time . "','0')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        if ($result) {
            return $utils->getMessageBar("Your bidding request successfully submitted", "s");
        } else {
            return $utils->getMessageBar("Unable to submit your bidding request", "e");
        }
    }

    function loadWastagePost($post_code, $user_id)
    {
        $query = "SELECT
	wastage.*, 
	city.iddistrict as district_id, 
	`user`.iduser
        FROM
	wastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser AND
		wastage.iduser = `user`.iduser
	INNER JOIN
	city
	ON 
		wastage.idcity = city.idcity AND
		wastage.idcity = city.idcity
	INNER JOIN
	district
	ON 
		city.iddistrict = district.iddistrict AND
		city.iddistrict = district.iddistrict
        WHERE 
        wastage.iduser='" . $user_id . "' AND wastage.idwastage='" . $post_code . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return null;
    }

    function loadWastageSinglePost($post_code)
    {
        $query = "SELECT
	wastage.*, 
	wastage.status as post_status,
	IF(max(wastage.balance_qty)>0,'','Sold Out') as status,
	city.`name` AS city_name, 
	district.`name` AS district_name
        FROM
	wastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser AND
		wastage.iduser = `user`.iduser
	INNER JOIN
	city
	ON 
		wastage.idcity = city.idcity AND
		wastage.idcity = city.idcity
	INNER JOIN
	district
	ON 
		city.iddistrict = district.iddistrict AND
		city.iddistrict = district.iddistrict
        WHERE 
        wastage.idwastage='" . $post_code . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return null;
    }


    function loadAllInvoice($user_id)
    {
        $query = "SELECT
	invoice.idwastage, 
	wastage.title, 
	invoice.*, 
	invoice.date, 
	invoice.idinvoice, 
	invoice.qty, 
	invoice.total
FROM
	invoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage WHERE invoice.iduser='" . $user_id . "' ORDER BY `date` ASC";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadAllCronJob()
    {
        $query = "SELECT * FROM cron_job";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);

        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }
    function loadAllCronJobNotifers($cronJobID)
    {
        $query = "SELECT
	`user`.`name`, 
	`user`.email, 
	user_notifier.iduser, 
	user_notifier.idwastage
FROM
	user_notifier
	INNER JOIN
	`user`
	ON 
		user_notifier.iduser = `user`.iduser
WHERE
	user_notifier.idcron_job = '".$cronJobID."'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);

        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadAllBiddings($company_id, $post_id, $status)
    {
        $checkPostID = "";
        if (!empty($post_id)) {
            $checkPostID = " AND wastage.idwastage='" . $post_id . "' ";
        }
        $checkPostStatus = "";
        if (!empty($status)) {
            if ($status == "1") {
                $checkPostStatus = " AND wastage.status=1";
            }
        }
        $query = "SELECT
	`user`.idcompany_reg, 
	wastage.idwastage, 
	wastage.status as post_status, 
	wastage.title, 
	wastage.total_price, 
	bidding_wastage.price, 
	bidding_wastage.remark, 
	bidding_wastage.`status`, 
	bidding_wastage.created_by, 
	bidding_wastage.id_bidding
FROM
	bidding_wastage
	INNER JOIN
	wastage
	ON 
		bidding_wastage.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE user.idcompany_reg='" . $company_id . "'" . $checkPostID . $checkPostStatus . " ORDER BY wastage.idwastage ASC";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);

        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadAllDiscounts($company_id, $post_id)
    {
        $query = "SELECT
	`user`.idcompany_reg, 
	discount.percentage, 
	discount.`status`, 
	discount.discount_code
FROM
	discount
	INNER JOIN
	wastage
	ON 
		discount.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE user.idcompany_reg='" . $company_id . "' AND discount.idwastage='" . $post_id . "' ORDER BY discount.percentage ASC";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function loadAllOrders($company_id, $post_id)
    {
        $checkPostID = "";
        if (!empty($post_id)) {
            $checkPostID = " AND wastage.idwastage='" . $post_id . "' ";
        }
        $query = "SELECT
	invoice.idinvoice, 
	wastage.idwastage, 
	wastage.title, 
	invoice.delivery_address, 
	invoice.billing_note, 
	invoice.date AS inv_date, 
	delivery_tracker.date AS tracker_date, 
	delivery_tracker.status_name, 
	invoice.`status`, 
	user.idcompany_reg
FROM
	invoice
	INNER JOIN
	delivery_tracker
	ON 
		invoice.idinvoice = delivery_tracker.idinvoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser WHERE user.idcompany_reg='" . $company_id . "'" . $checkPostID . " ORDER BY delivery_tracker.iddelivery_tracker ASC";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[$row['idinvoice']] = $row;
        }
        return $temp_array;
    }

    function loadInvoice($invoice_id, $user_id)
    {
        $query = "SELECT
	invoice.idwastage as postID, 
	wastage.title, 
	invoice.date, 
	invoice.type, 
	invoice.idinvoice, 
	invoice.fname, 
	invoice.lname, 
	invoice.email, 
	invoice.billing_address, 
	invoice.total, 
	invoice.discount_amount, 
	invoice.discount_percentage, 
	invoice.delivery_amount, 
	invoice.sub_total, 
	invoice.qty, 
	invoice.unit_price, 
	invoice.billing_note
FROM
	invoice
	INNER JOIN
	wastage
	ON 
		invoice.idwastage = wastage.idwastage WHERE idinvoice='" . $invoice_id . "' AND invoice.iduser='" . $user_id . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return "";
    }

    function selectedPreferredBuyers($iduser_type, $post_code)
    {
        $query = "SELECT * FROM preferred_user_type WHERE iduser_type='" . $iduser_type . "' AND idwastage='" . $post_code . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return "";
    }

    function isAlreadyBid($iduser, $post_code)
    {
        $query = "SELECT * FROM bidding_wastage WHERE iduser='" . $iduser . "' AND idwastage='" . $post_code . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        $temp_array = $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }

        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return "";
    }

    function updateResturentMenuStatus($item_id, $item_code, $change_status, $company_id)
    {
        $status = ($change_status == "Active") ? '0' : '1';
        $query = "UPDATE rest_menu SET status='" . $status . "' WHERE idrest_menu='" . $item_id . "' AND idcompany_reg='" . $company_id . "'";
        $stmt = $this->connect()->query($query);
        $utils = new utils();
        if ($stmt) {
            $newStatus = ($status == '0') ? 'active' : 'inactive';
            return $utils->getMessageBar("Item " . $item_code . " is " . $newStatus, "s");
        } else {
            return $utils->getMessageBar("Unable to change item status", "e");
        }
    }

    function emailVerifiy(string $email)
    {

        $qurry = "SELECT `email` FROM `user` where `email` = '" . $email . "' ";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow > 0) {

            $msg = 'true';
        } else {
            $msg = 'false';
        }

        return $msg;
    }

    function loadPreferredBuyersTime()
    {
        $temp_array = array();
        $temp_array[] = array("value" => '1', 'text' => "1 Hours");
        $temp_array[] = array("value" => '2', 'text' => "2 Hours");
        $temp_array[] = array("value" => '3', 'text' => "3 Hours");
        $temp_array[] = array("value" => '4', 'text' => "4 Hours");
        $temp_array[] = array("value" => '5', 'text' => "5 Hours");
        $temp_array[] = array("value" => '6', 'text' => "6 Hours");
        $temp_array[] = array("value" => '7', 'text' => "7 Hours");
        $temp_array[] = array("value" => '8', 'text' => "8 Hours");
        $temp_array[] = array("value" => '9', 'text' => "9 Hours");
        $temp_array[] = array("value" => '10', 'text' => "10 Hours");
        $temp_array[] = array("value" => '12', 'text' => "12 Hours");
        $temp_array[] = array("value" => '14', 'text' => "14 Hours");
        $temp_array[] = array("value" => '16', 'text' => "16 Hours");
        $temp_array[] = array("value" => '18', 'text' => "18 Hours");
        $temp_array[] = array("value" => '20', 'text' => "20 Hours");
        $temp_array[] = array("value" => '24', 'text' => "24 Hours (One Days)");
        $temp_array[] = array("value" => '28', 'text' => "28 Hours");
        $temp_array[] = array("value" => '30', 'text' => "30 Hours");
        $temp_array[] = array("value" => '34', 'text' => "34 Hours");
        $temp_array[] = array("value" => '38', 'text' => "38 Hours");
        $temp_array[] = array("value" => '40', 'text' => "40 Hours");
        $temp_array[] = array("value" => '48', 'text' => "48 Hours (Two Days)");
        $temp_array[] = array("value" => '60', 'text' => "60 Hours (Two & Half Days)");
        $temp_array[] = array("value" => '72', 'text' => "72 Hours (Three Days)");
        $temp_array[] = array("value" => '84', 'text' => "84 Hours (Three & Half Days)");
        $temp_array[] = array("value" => '92', 'text' => "91 Hours (Four Days)");
        $temp_array[] = array("value" => '108', 'text' => "108 Hours (Four & Half Days)");
        $temp_array[] = array("value" => '120', 'text' => "120 Hours (Five Days)");
        $temp_array[] = array("value" => '132', 'text' => "132 Hours (Five & Half Days)");
        $temp_array[] = array("value" => '150', 'text' => "150 Hours (Six Days)");
        $temp_array[] = array("value" => '162', 'text' => "162 Hours (Six & Half Days)");
        return $temp_array;
    }

    function loadPreferredUserType($post_code)
    {
        $query = "SELECT
	preferred_user_type.preferred_time, 
	preferred_user_type.preferred_discount_leverage, 
	user_type.iduser_type, 
	user_type.type, 
	user_type.priority,
	user_type.user_type_image
FROM
	preferred_user_type
	INNER JOIN
	user_type
	ON 
		preferred_user_type.iduser_type = user_type.iduser_type
WHERE
	preferred_user_type.idwastage = '" . $post_code . "'
ORDER BY
	user_type.priority ASC";
//        echo $query;
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
//        return $result->fetch_all(MYSQLI_ASSOC);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        return $temp_array;
    }

    function admList()
    {


        $qurry = "SELECT `name`,`email`,`status` FROM `admin`";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow > 0) {

            while ($getValue = mysqli_fetch_array($result)) {
                $msg[] = array("userName" => $getValue['name'], "userEmail" => $getValue['email'], "userStatus" => $getValue['status']);
            }


        } else {
            $msg[] = array("userName" => 'Nodata', "userEmail" => 'Nodata', "userStatus" => '0');
        }

        return $msg;

    }

    function loadUserDetailsByUserType($user_type)
    {
        $query = "SELECT iduser,name,email FROM user WHERE iduser_type='" . $user_type . "' AND status='1'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
        return $temp_array;
    }

    function postUpdate($postId, $statusId, $notifyer)
    {
        $qurry = "UPDATE `wastage` SET `status` = '$statusId' WHERE `idwastage` = '$postId'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        if ($result == 1) {
            $msg = 'pass';
            if ($notifyer == "1" && $statusId == "1") {
                $activeUserType = $this->getCurrentActiveUserType($postId);
                $userArray = $this->loadUserDetailsByUserType($activeUserType);
                $baseURL = "https://wasty.learner.cc";
                foreach ($userArray as $value) {
                    $body = '<div style="background: white;border: 1px solid #E5E8E8; border-radius: 5px; padding: 10px;">
                                <h3>Hi ' . $value["name"] . ',</h3>
                                <p>Good day! We found new post for your. Its match for your profile. Click this button</p>
                                <a href="' . $baseURL . '/profile/product_detail.php?id=' . $postId . '" style="background-color: #4CAF50;color: white;padding: 10px;text-align: center;text-decoration: none; border-radius:5px;">Open Ads</a>
                                <h3>Thank you!</h3>
                               </div>';
                    $this->sendEmail($value["email"], "New post found for you", $body);
                }
            }
        } else {
            $msg = 'fail';
        }
        return $msg;
    }

    function getCurrentActiveUserType($postId)
    {
        $utils = new utils();
        $responseEditItem = $this->loadWastageSinglePost($postId);
        $responsePreferredUserType = $this->loadPreferredUserType($postId);
        $sDate = date('Y-m-d H:i', strtotime($utils->getValue($responseEditItem, "date")));
        foreach ($responsePreferredUserType as $value) {
            try {
                $datetime = new DateTime($sDate);

                $datetime->add(new DateInterval('PT' . $value["preferred_time"] . 'H'));

                $textStyle = "";
                $currentDateTime = date('Y-m-d H:i');
                $dateBegin = date('Y-m-d H:i', strtotime($sDate));
                $dateEnd = date('Y-m-d H:i', strtotime($datetime->format('Y-m-d H:i')));


                if (($currentDateTime >= $dateBegin) && ($currentDateTime <= $dateEnd)) {
                    return $value["iduser_type"];
                }
                $sDate = $dateEnd;
            } catch (Exception $e) {
            }
        }
        return "";
    }


    function userList()
    {


        $qurry = "SELECT `iduser`,`name`,`email`,`status`,`idcompany_reg` FROM `user`";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow > 0) {

            while ($getValue = mysqli_fetch_array($result)) {
                $msg[] = array("userId" => $getValue['iduser'], "userName" => $getValue['name'], "userEmail" => $getValue['email'], "userStatus" => $getValue['status'], "companyId" => $getValue['idcompany_reg']);
            }


        } else {
            $msg[] = array("userId" => 'Nodata', "userName" => 'Nodata', "userEmail" => 'Nodata', "userStatus" => '0', "companyId" => "0");
        }

        return $msg;

    }


    function userUpdate($userId, $statusId)
    {

        $qurry = "UPDATE `user` SET `status` = '$statusId' WHERE `iduser` = '$userId'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);

        if ($result == 1) {

            $msg = 'pass';

        } else {

            $msg = 'fail';
        }

        return $msg;
    }

    function companyDetails($companyId)
    {

        $qurry = "SELECT * FROM `company_reg` WHERE `idcompany_reg`='$companyId'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $qurry);
        $nuwrow = mysqli_num_rows($result);

        if ($nuwrow > 0) {

            while ($getValue = mysqli_fetch_array($result)) {
                $msg[] = array("companyName" => $getValue['name'], "companyAddress" => $getValue['address'], "companyContact" => $getValue['contact_no'], "companyPerson" => $getValue['contact_pname'], "companyBR" => $getValue['proof_url']);
            }

        } else {

            $msg[] = array("companyName" => "No Data", "companyAddress" => "No Data", "companyContact" => "No Data", "companyPerson" => "No Data", "companyBR" => "No Data");
        }

        return $msg;


    }

    function loadAllActivePosts()
    {
        $query = "SELECT
	wastage.idwastage, 
	wastage.image, 
	wastage.title, 
	wastage.total_price
FROM
	wastage
	INNER JOIN
	`user`
	ON 
		wastage.iduser = `user`.iduser
WHERE
	wastage.`status` = 1";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
        return $temp_array;
    }

    function getCronJobDetail($cronJobID)
    {
        $query = "SELECT * FROM cron_job WHERE idcron_job='" . $cronJobID . "'";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $temp_array = array();
        while ($getValue = mysqli_fetch_array($result)) {
            $temp_array[] = $getValue;
        }
        if (count($temp_array) == 1) {
            return $temp_array[0];
        }
        return "";
    }

    function runCronJob()
    {
        $postArray = $this->loadAllActivePosts();
        $temp_array = array();
        foreach ($postArray as $posts) {
            $activeUserType = $this->getCurrentActiveUserType($posts["idwastage"]);
            if (!empty($activeUserType)) {
                $temp_array[$activeUserType][] = $posts;
            }
        }
        $date_time = date("Y-m-d h:m:s");
        $lastCronJobID = $this->getLastID("cron_job", "idcron_job");
        $query = "INSERT INTO cron_job VALUE('" . $lastCronJobID . "','" . $date_time . "')";
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);

        $baseURL = "https://wasty.learner.cc";
        foreach (array_keys($temp_array) as $userType) {
            $userArray = $this->loadUserDetailsByUserType($userType);
            foreach ($userArray as $user) {
                $postHTML = "";
                foreach ($temp_array[$userType] as $posts) {
                    $query = "SELECT * FROM user_notifier WHERE idwastage='".$posts["idwastage"]."' AND iduser='".$user["iduser"]."'";
                    $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
                    $cronjob_temp_array = array();
                    while ($getValue = mysqli_fetch_array($result)) {
                        $cronjob_temp_array[] = $getValue;
                    }
                    if (count($cronjob_temp_array) == 0) {
                        $postHTML = $postHTML .
                            '<a href="' . $baseURL . '/profile/product_detail.php?id=' . $posts["idwastage"] . '" style="text-decoration: none; color: #0b0b0b">
                        <div style="width: 200px; border: 1px solid #F4F6F6;border-radius: 5px; margin-top: 10px;box-shadow: 2px 2px #F4F6F6;">
                            <img src="' . $baseURL . '/profile/' . $posts["image"] . '" style="height: 150px; width: 200px; object-position: center;border-radius: 5px"/>
                            <p style="margin: 5px;">' . $posts["title"] . '</p>
                            <h4 style="margin: 5px;">RS.' . $posts["total_price"] . '</h4>
                        </div>
                    </a>';
                    }

                }

                if(!empty($postHTML)){
//                    echo $user["iduser"].'<br>';
                    $body = '<div style="background: white;border: 1px solid #F4F6F6; border-radius: 5px; padding: 10px;">
                            <h3>Hi ' . $user["name"] . ',</h3>
                            <p>Good day! We found new post for your. its match for profile. Click this ads buy immediately</p>
                            ' . $postHTML . '
                            <h3>Thank you!</h3>
                        </div>';
                    $responseEmail = $this->sendEmail($user["email"], "New post found for you", $body);
                    if ($responseEmail == "email send") {
                        foreach ($temp_array[$userType] as $posts) {
                            $query = "INSERT INTO user_notifier VALUE('0','" . $lastCronJobID . "','" . $user["iduser"] . "','".$posts["idwastage"]."')";
                            $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
                        }
                    }
                }
            }
        }
        return $lastCronJobID;
    }

    function sendEmail($email, $subject, $body)
    {
        try {
            if (!class_exists('PHPMailer\PHPMailer\Exception')) {
                require $_SERVER['DOCUMENT_ROOT'] . '/admin/PHPMailer/src/Exception.php';
                require $_SERVER['DOCUMENT_ROOT'] . '/admin/PHPMailer/src/PHPMailer.php';
                require $_SERVER['DOCUMENT_ROOT'] . '/admin/PHPMailer/src/SMTP.php';
            }
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wasteyproject@gmail.com';
            $mail->Password = 'geaypigpxftaedvt';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('wasteyproject@gmail.com', 'Wastey');
            $mail->addAddress($email);
            $mail->addReplyTo('wasteyproject@gmail.com', 'Wastey');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            $res = "email send";
        } catch (Exception $e) {
            $res = "email not send";
        }
        return $res;
    }

    function getLastID($tableName, $tableID)
    {

        $query = "SELECT MAX(" . $tableID . ") as id FROM " . $tableName;
        $result = mysqli_query($GLOBALS["__mysqli_connect"], $query);
        $getValue = mysqli_fetch_array($result);
        $lastIDDDDD = 0;
        if ($getValue["id"] != "") {
            $lastIDDDDD = $getValue["id"] + 1;
        } else {
            $lastIDDDDD = 1;
        }
        return $lastIDDDDD;
    }

}

?>