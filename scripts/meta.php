<?php
if (isset($_GET['pageid'])) {
    $pagetitleid = db_escape($_GET['pageid']);
    $query = "SELECT * FROM tbl_page WHERE id='$pagetitleid'";
    $pages = db_select($query);
    if ($pages) {
        while ($result = mysqli_fetch_assoc($pages)) { ?>
<title><?php echo $result['name']; ?> - My Blog</title>
        <?php }
    }
} elseif (isset($_GET['id'])) {
    $postid = db_escape($_GET['id']);
    $query = "SELECT * FROM tbl_post WHERE id='$postid'";
    $posts = db_select($query);
    if ($posts) {
        while ($result = mysqli_fetch_assoc($posts)) { ?>
<title><?php echo $result['tittle']; ?> - My Blog</title>
        <?php }
    }
} else { ?>
    <title>My Blog</title>
<?php } ?>
<meta name="language" content="English">
<meta name="description" content="It is a website about education">
<?php
if (isset($_GET['id'])) {
    $keywordid = db_escape($_GET['id']);
    $query = "SELECT * FROM tbl_post WHERE id='$keywordid'";
    $keywords = db_select($query);
    if ($keywords) {
        while ($result = mysqli_fetch_assoc($keywords)) { ?>
            <meta name="keywords" content="<?php echo $result['tags']; ?>">
        <?php }
    }
} else { ?>
    <meta name="keywords" content="blog, php">
<?php } ?>
<meta name="author" content="Delowar">
