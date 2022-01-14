<?php /** @var Array $data */ ?>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Počet produktov</th>
        <th scope="col">Dátum objednania</th>
        <th scope="col">Cena spolu</th>
    </tr>
    </thead>
    <tbody class="tbody">
    <?php $pocet = 0;
    foreach ($data['orders'] as $order) {
        $pocet++;?>
    <tr>
            </td>
            <td><?php $pocet ?></td>
            <td><?php $order->getNumberOfProducts() ?></td>
            <td><?php $order->getDate() ?></td>
            <td><?php $order->getTotalPrice() ?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>