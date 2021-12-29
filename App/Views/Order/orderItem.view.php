<?php /** @var Array $data */ ?>
<ul class="list-group list-group-flush">
    <?php foreach ($data['order_item'] as $item) { ?>
        <li class="list-group-item"><?php echo $item->getProductName() ?></li>
    <?php } ?>
</ul>