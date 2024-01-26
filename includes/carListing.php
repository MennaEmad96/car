<div class="row">
    <div class="col-lg-7">
        <h2 class="section-heading"><strong>Car Listings</strong></h2>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>    
    </div>
</div>

<div class="row">
    <?php
        foreach($stmt->fetchAll() as $row){
            $id=$row["id"];
            $title=$row["title"];
            $price=$row["price"];
            $luggage=$row["luggage"];
            $doors=$row["doors"];
            $passenger=$row["passenger"];
            $content=$row["content"];
            $image=$row["image"];
            $category_id=$row["category_id"]; 
    ?>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="listing d-block  align-items-stretch">
        <div class="listing-img h-100 mr-4">
            <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-fluid" width=100%>
        </div>
        <div class="listing-contents h-100">
            <h3><?php echo $title; ?></h3>
            <div class="rent-price">
            <strong>$<?php echo $price; ?></strong><span class="mx-1">/</span>day
            </div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
            <div class="listing-feature pr-4">
                <span class="caption">Luggage:</span>
                <span class="number"><?php echo $luggage; ?></span>
            </div>
            <div class="listing-feature pr-4">
                <span class="caption">Doors:</span>
                <span class="number"><?php echo $doors; ?></span>
            </div>
            <div class="listing-feature pr-4">
                <span class="caption">Passenger:</span>
                <span class="number"><?php echo $passenger; ?></span>
            </div>
            </div>
            <div>
            <p><?php echo $content; ?></p>
            <p><a href="single.php?id=<?php echo $id;?>" class="btn btn-primary btn-sm">Rent Now</a></p>
            </div>
        </div>

        </div>
    </div>
    <?php } ?>
</div>

