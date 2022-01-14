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
    <?php foreach ($data['orders'] as $product) { ?>
            </td>
            <td>1</td>
            <td>2</td>
            <td>14.01.2022</td>
            <td>2€</td>
    <?php } ?>

    </tr>
    </tbody>
</table>
