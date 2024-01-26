<!-- alert section -->
<?php if(isset($message)){ ?>
    <div class="alert <?php echo $alert; ?> alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $message; ?></strong>
    </div>
<?php unset($_SESSION["user"]); } ?>