<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">

        <?php foreach ($data['orders'] as $order) { ?>
            <div class="col-lg-4 col-md-6 mt-2">
                <a><?php $order->getUserId() ?></a>
                <form method="post" action="">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-title"><?php echo $order->getId() ?></h5>
                        <button type="submit" name="sub">Add to cartdsdsd</button>
                        <input type="hidden" name="order_id" value="<?php $order->getId() ?>">
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
