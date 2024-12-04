<?php include "includes/header.php";
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php"; 

$promotion = showPromotions();
$apply = showPromotionsEmploy($IDUsuario);
?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the Promotions</h2>
        <p>In this section you can see the internal promotions, where you can apply for them only once. You can also see your application history and see if they were accepted or denied.</p>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-striped table-sm">
        <thead style="background-color: #007bff; color: white;"> <!-- Color azul -->
        <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Publication Date</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($promotion as $renglon){ ?>
                <tr>
                    <td><?=$renglon['code']?></td>
                    <td><?=$renglon['name']?></td>
                    <td><?=$renglon['description']?></td>
                    <td><?=$renglon['publicationDate']?></td>
                    <td><a href="applyPromotion.php?id=<?php echo $renglon['code']?>" class="btn btn-primary btn-sm">Apply</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($apply)){ ?>
    <div>
        <h2 class="text-center">My Applies</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
            <thead class="custom-thead"> 
            <thead style="background-color: #007bff; color: white;"> <!-- Color azul -->
            <tr>
                        <th>Id</th>
                        <th>Apply Date</th>
                        <th>Status</th>
                        <th>Promotion</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($apply as $renglon){ ?>
                    <tr>
                        <td><?=$renglon['id']?></td>
                        <td><?=$renglon['publicationDate']?></td>
                        <td><?=$renglon['status']?></td>
                        <td><?php echo promotionName($renglon['promotion']);?></td>
                        <td><a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</section>

<?php include "includes/footer.php"; ?>
