<div class="row justify-content-center">
    <div class="col-lg-4">
        <?php foreach($arrLabs as $k => $objLab) { ?>
            <div class="my-3">
                <a class="btn btn-primary btn-block" href="<?php echo "?lab_id=" . $objLab->getId() ?>" role="button">
                    <?php
                        echo $objLab->getName();
                    ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>


