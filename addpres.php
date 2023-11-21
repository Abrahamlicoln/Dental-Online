<?php
include 'database_connection.php';
session_start();
$id = $_SESSION['id'];


if (isset($_POST['addpres'])) {
    $description = filter_var(mysqli_real_escape_string($connection, $_POST['description']), FILTER_SANITIZE_STRING);
    $description = nl2br($description);
    $update = "UPDATE patient SET description='$description' WHERE id='$id'";
    $result = mysqli_query($connection, $update);
    if ($result) {
        if ($result) {
            $select = "SELECT * FROM patient WHERE id = '$id'";
            $result = mysqli_query($connection, $select);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $phone_number = $row['phone_number'];
                    $fullname = $row['fullname'];
                    $date_appoint = $row['date_of_appointment'];
                    $date = date("l, F j, Y", strtotime($date_appoint));
                }
            }
            $message = "Dear " . strtoupper($fullname) . " Base on Your Symptoms received during your Appointment on  " . $date_appoint . " Your Test Result are listed Below \n" . $description . "\n";
            $main_response = array();
            $headers = array('Content-Type: application/x-www-form-urlencoded');
            $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
            $arr_params = [
                'from' => 'FMC KEFFI',
                'to' => $phone_number,
                'body' => $message,

                'append_sender' => 2, // Choose your Append Sender ID Option:
                //1 for none,
                // 2 for Hosted SIM Only
                // and 3 for all

                'api_token' => '9KQ5B9MISl5PuEdWY2l05q0m1EHmo8L6AP4odIkPHMp80gh56nCqsP01C7rD', //Todo: Replace with your API Token

                'dnd' => 6, //Choose your preferred DND Management Option:
                // 1 for Get a refund,
                // 2 for Direct hosted SIM,
                // 3 for Hosted SIM Only,
                // 4 for Dual-Backup and
                // 5 for Dual-Dispatch
            ];
            if (is_array($arr_params)) {
                $final_url_data = http_build_query($arr_params, '', '&');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $main_response['body'] = curl_exec($ch);
            $main_response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $_SESSION['result'] = "Set";
            header("Location:dashboard.php");
        }
        $_SESSION['description'] = "Set";
        header("Location:dashboard.php");
    }
}
