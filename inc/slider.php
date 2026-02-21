<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = "SELECT * FROM tbl_slider ORDER BY id LIMIT 5";
        $slider = db_select($query);
        if ($slider) {
            while ($result = mysqli_fetch_assoc($slider)) { ?>
                <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></a>
        <?php }
        } ?>
    </div>
</div>
