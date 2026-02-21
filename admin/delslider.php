<?php
require_once '../dbconnect.php';
session_check();

$sliderid = db_escape($_GET['sliderid']);
if (!isset($sliderid) || $sliderid == null) {
    echo "<script>window.location = 'sliderlist.php'; </script>";
} else {
    $query   = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
    $getData = db_select($query);
    if ($getData) {
        while ($delimg = mysqli_fetch_assoc($getData)) {
            $dellink = $delimg['image'];
            if (file_exists($dellink)) unlink($dellink);
        }
    }
    $delquery = "DELETE FROM tbl_slider WHERE id='$sliderid'";
    $delData  = db_query($delquery);
    if ($delData) {
        echo "<script>alert('Slider Deleted Successfully')</script>";
        echo "<script>window.location = 'sliderlist.php'; </script>";
    } else {
        echo "<script>alert('Slider Not Deleted')</script>";
        echo "<script>window.location = 'sliderlist.php'; </script>";
    }
}
