<?php
require_once '../dbconnect.php';
session_check_login();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
    <section id="content">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = validate($_POST['username']);
            $password = validate(md5($_POST['password']));
            $username = db_escape($username);
            $password = db_escape($password);

            $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
            $result = db_select($query);
            if ($result != false) {
                $value = mysqli_fetch_assoc($result);
                session_set("login", true);
                session_set("username", $value['username']);
                session_set("userId", $value['id']);
                session_set("userRole", $value['role']);
                header("Location:index.php");
                exit();
            } else {
                echo "<span style='color:red; font-size:18px;'>Username or Password not matched!!.</span>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <h1>Admin Login</h1>
            <div><input type="text" placeholder="Username" required="" name="username"/></div>
            <div><input type="password" placeholder="Password" required="" name="password"/></div>
            <div><input type="submit" value="Log in" /></div>
        </form>
        <div class="button"><a href="forgetpass.php">Forgot Password !</a></div>
        <div class="button"><a href="#">Training with live project</a></div>
    </section>
</div>
</body>
</html>
