<?php
include 'database_connection.php';
session_start();
$id = $_SESSION['id'];
if (isset($_POST['approved'])) {
    $name = filter_var(mysqli_real_escape_string($connection, $_POST['fullname']), FILTER_SANITIZE_STRING);
    $number = filter_var(mysqli_real_escape_string($connection, $_POST['phone_number']), FILTER_SANITIZE_STRING);
    $date_of_appointment = filter_var(mysqli_real_escape_string($connection, $_POST['date_of_appointment']), FILTER_SANITIZE_STRING);
    $time_of_appointment = filter_var(mysqli_real_escape_string($connection, $_POST['time_of_appointment']), FILTER_SANITIZE_STRING);
    $date = date("l, F j, Y", strtotime($date_of_appointment));
    $time = substr($time_of_appointment, 0, 2);
    if ($time > "12") {
        $time =  $time - 12;
        $new_time = substr($time_of_appointment, 3, 6);
        $time_of_appointment = $time . ":" . $new_time . "PM";
    } else {
        $time_of_appointment = $time_of_appointment . "AM";
    }

    $update = "UPDATE patient SET date_of_appointment='$date_of_appointment',time_of_appoinment = '$time_of_appointment',status='1' WHERE id='$id'";
    $result = mysqli_query($connection, $update);
    if ($result) {
        $_SESSION['successful'] = "Set";
        $message = "Dear " . strtoupper($name) . " Your Appointment with Dr. Loko Usman is Successfully Approved. Your are Expected to be Present on " . $date . " by " . $time_of_appointment;
        $main_response = array();
        $headers = array('Content-Type: application/x-www-form-urlencoded');
        $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
        $arr_params = [
            'from' => 'Dr. Loko Usman',
            'to' => $number,
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
        $_SESSION['successful'] = "set";
        header("Location:dashboard.php");
    }
}
