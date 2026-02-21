<?php
require_once '../dbconnect.php';
session_check();

$delpage = db_escape($_GET['delpage']);
if (!isset($delpage) || $delpage == null) {
    echo "<script>window.location = 'index.php'; </script>";
} else {
    $delquery = "DELETE FROM tbl_page WHERE id='$delpage'";
    $delData  = db_query($delquery);
    if ($delData) {
        echo "<script>alert('Page Deleted Successfully')</script>";
        echo "<script>window.location = 'index.php'; </script>";
    } else {
        echo "<script>alert('Page Not Deleted')</script>";
        echo "<script>window.location = 'index.php'; </script>";
    }
}
