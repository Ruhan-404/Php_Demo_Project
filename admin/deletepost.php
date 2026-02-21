<?php
require_once '../dbconnect.php';
session_check();

$delpostid = db_escape($_GET['delpostid']);
if (!isset($delpostid) || $delpostid == null) {
    echo "<script>window.location = 'postlist.php'; </script>";
} else {
    $query   = "SELECT * FROM tbl_post WHERE id='$delpostid'";
    $getData = db_select($query);
    if ($getData) {
        while ($delimg = mysqli_fetch_assoc($getData)) {
            $dellink = $delimg['image'];
            if (file_exists($dellink)) unlink($dellink);
        }
    }
    $delquery = "DELETE FROM tbl_post WHERE id='$delpostid'";
    $delData  = db_query($delquery);
    if ($delData) {
        echo "<script>alert('Data Deleted Successfully')</script>";
        echo "<script>window.location = 'postlist.php'; </script>";
    } else {
        echo "<script>alert('Data Not Deleted')</script>";
        echo "<script>window.location = 'postlist.php'; </script>";
    }
}
