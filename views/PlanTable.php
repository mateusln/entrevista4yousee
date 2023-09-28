<!DOCTYPE html>
<html>

<head>
    <title>Tabela de planos</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<?php

function convertToBrazilianDate($date)
{
    $date = new DateTime($date);
    return $date->format('d/m/Y');
}

function convertToMoneyBr($money)
{
    return 'R$ ' . number_format($money, 2, ',', '.');
}

?>
<body>
    <table>
        <tr>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Preço do Telefone</th>
            <th>Preço do Telefone no Plano</th>
            <th>Parcelas</th>
            <th>Taxa mensal</th>
            <th>Data de inicio</th>
            <th>Localidade</th>
        </tr>

        <?php foreach ($this->dataTable as $row) : ?>
            <tr>
                <td><?= $row['type']; ?></td>
                <td><?= $row['name']; ?>, <?= $row['localidade']['nome']; ?></td>
                <td><?= convertToMoneyBr($row['phonePrice']); ?></td>
                <td><?= convertToMoneyBr($row['phonePriceOnPlan']); ?></td>
                <td><?= $row['installments']; ?></td>
                <td><?= convertToMoneyBr($row['monthly_fee']); ?></td>
                <td><?= convertToBrazilianDate($row['schedule']['startDate']); ?></td>
                <td><?= $row['localidade']['nome']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
