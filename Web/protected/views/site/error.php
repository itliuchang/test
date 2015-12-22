<?php if($code == 404): ?>
    <div class="error error404">
        <img src="/images/404.png" alt="">
        <!-- <p>Code: <?php echo $code ?></p> -->
        <!-- <p>message: <?php echo CHtml::encode($message) ?></p> -->
        <!-- <p>message: <?php echo CHtml::encode($file) ?></p> -->
        <!-- <p>message: <?php echo CHtml::encode($trace) ?></p> -->
        <!-- <p>message: <?php echo CHtml::encode(json_encode($traces)) ?></p> -->
    </div>
<?php elseif($code == 403): ?>
    <div class="error error403">
        <img src="/images/403.png" alt="">
        <p class="msg"><?php echo CHtml::encode($message) ?></p>
    </div>
<?php else: ?>
    <div class="error error500">
        <img src="/images/500.jpg" alt="">
    </div>
<?php endif; ?>