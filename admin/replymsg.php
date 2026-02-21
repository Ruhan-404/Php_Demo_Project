<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
$msgid = mysqli_real_escape_string($conn, $_GET['msgid']);
if (!isset($msgid) || $msgid == null) {
    echo "<script>window.location = 'inbox.php'; </script>";
    // header("Location:catlist.php");
} else {
    $id = $msgid;
}

 ?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Message</h2>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to         = validate($_POST['toEmail']);
    $from       = validate($_POST['fromEmail']);
    $Subject    = validate($_POST['subject']);
    $message    = validate($_POST['message']);
    $sendmail   = mail($to, $Subject, $message, $from);

    if ($sendmail) {
        echo '<span class="success">Message Sent Successfully.</span>';
    } else {
        echo '<span class="error">Message Not Sent.</span>';
    }
}


 ?>

                <div class="block">               
                 <form action="" method="POST">   
                 <?php 
                        $query = "SELECT * FROM tbl_contact WHERE id='$id'";
                        $msg = db_select($query);
                        if ($msg) {
                            while ($result = mysqli_fetch_assoc($msg)) {
                                ?>                 
                    <table class="form">
                       
                        
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message" colspan="15"></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php
                            }
                        } ?>
                    </form>
                </div>
            </div>
        </div>

<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <?php include 'inc/footer.php' ?>



