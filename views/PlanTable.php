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
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phonePrice']; ?></td>
                <td><?php echo $row['phonePriceOnPlan']; ?></td>
                <td><?php echo $row['installments']; ?></td>
                <td><?php echo $row['monthly_fee']; ?></td>
                <td><?php echo $row['schedule']['startDate']; ?></td>
                <td><?php echo $row['localidade']['nome']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
