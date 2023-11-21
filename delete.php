<?php
include 'database_connection.php';
session_start();
if (isset($_GET['patient_id'])) {
    $id = $_GET['patient_id'];
    $delete = "DELETE FROM patient WHERE id='$id'";
    $result = mysqli_query($connection, $delete);
    if ($result) {
        header("Location:dashboard.php");
    }
}
