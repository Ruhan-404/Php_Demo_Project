<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            <?php
            $query = "SELECT * FROM tbl_category";
            $category = db_select($query);
            if ($category) {
                while ($result = mysqli_fetch_assoc($category)) { ?>
                    <li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
            <?php }
            } else { ?>
                <li>No Category Created.</li>
            <?php } ?>
        </ul>
    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php
        $query = "SELECT * FROM tbl_post LIMIT 5";
        $post = db_select($query);
        if ($post) {
            while ($result = mysqli_fetch_assoc($post)) { ?>
                <div class="popular clear">
                    <h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['tittle']; ?></a></h3>
                    <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                    <?php echo text_shorten($result['body'], 120); ?>
                </div>
        <?php }
        } else {
            // no posts in sidebar - just skip
        } ?>
    </div>
</div>
