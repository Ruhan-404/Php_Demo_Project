<?php
require_once __DIR__ . '/../dbconnect.php';
session_init_app();
?>
<!DOCTYPE html>
<html>
<head>
    <?php require __DIR__ . '/../scripts/meta.php'; ?>
    <?php require __DIR__ . '/../scripts/css.php'; ?>
    <?php require __DIR__ . '/../scripts/js.php'; ?>
</head>

<body>
    <div class="headersection templete clear">
        <a href="index.php">
            <div class="logo">
                <?php
                $query = "SELECT * FROM title_slogan WHERE id='1'";
                $blog_title = db_select($query);
                if ($blog_title) {
                    while ($result = mysqli_fetch_assoc($blog_title)) { ?>
                        <img src="admin/<?php echo $result['logo']; ?>" alt="Logo"/>
                        <h2><?php echo $result['title']; ?></h2>
                        <p><?php echo $result['slogan']; ?></p>
                <?php }
                } ?>
            </div>
        </a>
        <div class="social clear">
            <div class="icon clear">
                <?php
                $query = "SELECT * FROM tbl_social WHERE id='1'";
                $social_media = db_select($query);
                if ($social_media) {
                    while ($result = mysqli_fetch_assoc($social_media)) { ?>
                        <a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                <?php }
                } ?>
            </div>
            <div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..."/>
                    <input type="submit" name="submit" value="Search"/>
                </form>
            </div>
        </div>
    </div>

    <div class="navsection templete">
        <?php
        $path = $_SERVER['SCRIPT_FILENAME'];
        $currentpage = basename($path, '.php');
        ?>
        <ul>
            <li><a <?php if ($currentpage == 'index') echo 'id=active'; ?> href="index.php">Home</a></li>
            <?php
            $query = "SELECT * FROM tbl_page";
            $pages = db_select($query);
            if ($pages) {
                while ($result = mysqli_fetch_assoc($pages)) { ?>
                    <li><a <?php if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) echo 'id="active"'; ?>
                        href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
            <?php }
            } ?>
            <li><a <?php if ($currentpage == 'contact') echo 'id=active'; ?> href="contact.php">Contact</a></li>
        </ul>
    </div>
