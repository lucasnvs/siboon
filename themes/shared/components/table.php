<table class="default-table">
    <thead>
        <?php foreach ($header as $th): ?>
            <th> <?= $th ?> </th>
        <?php endforeach; ?>
    </thead>
    <tbody>
        <?php foreach ($data as $tr): ?>
            <tr>
                <td>1</td>
                <td>Camisa</td>
                <td>R$ 100,00</td>
                <td>54</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>