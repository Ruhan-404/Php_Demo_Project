<?php include 'inc/header.php'; ?>

<?php 
$search = mysqli_real_escape_string($conn, $_GET['search']);
if (!isset($search) || $search == null) {
    header("Location:404.php");
} else {
    $search = $search;
}

 ?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">

          <?php 
            $query = "SELECT * FROM tbl_post WHERE tittle LIKE '%$search%' OR body LIKE '%$search%'";
            $post = db_select($query);
            if ($post) {
                while ($result = mysqli_fetch_assoc($post)) {
                    ?>

<div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['tittle']; ?></a></h2>
            <h4><?php echo format_date($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
            
                <?php echo text_shorten($result['body']); ?> 
            
            <div class="readmore clear">
                <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
            </div>
        </div>

        <?php
                }
            } else {
                ?>
<p>Your Search Query Not Found!!.</p>
            <?php
            } ?>

    </div>
    <?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>
