<?php
// =====================================================
//   DATABASE CONNECTION - EDIT THIS FILE FOR HOSTING
// =====================================================

$db_host = "localhost";        // Your hosting MySQL hostname
$db_user = "root";             // Your database username
$db_pass = "";                 // Your database password
$db_name = "db_blog";          // Your database name

// =====================================================
//   DO NOT EDIT BELOW THIS LINE
// =====================================================

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("<b>Database Connection Failed:</b> " . mysqli_connect_error());
}

// ---- Helper Functions (replaces Database & Format classes) ----

// Run a SELECT query, returns result or false
function db_select($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("<b>Query Error:</b> " . mysqli_error($conn) . " | Query: " . $query);
    }
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
    return false;
}

// Run INSERT / UPDATE / DELETE queries, returns true or false
function db_query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("<b>Query Error:</b> " . mysqli_error($conn) . " | Query: " . $query);
    }
    return $result;
}

// Escape a string safely
function db_escape($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}

// Format a date nicely
function format_date($date) {
    return date('F j, Y, g:i a', strtotime($date));
}

// Shorten text to a word boundary
function text_shorten($text, $limit = 400) {
    $text = $text . " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    return $text . "........";
}

// Sanitize / validate input
function validate($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// ---- Session Functions (replaces Session class) ----

function session_init_app() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function session_set($key, $val) {
    session_init_app();
    $_SESSION[$key] = $val;
}

function session_get($key) {
    session_init_app();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}

function session_check() {
    session_init_app();
    if (session_get("login") == false) {
        session_destroy();
        header("Location:login.php");
        exit();
    }
}

function session_check_login() {
    session_init_app();
    if (session_get("login") == true) {
        header("Location:index.php");
        exit();
    }
}

function session_destroy_app() {
    session_init_app();
    session_destroy();
    header("Location:login.php");
    exit();
}
