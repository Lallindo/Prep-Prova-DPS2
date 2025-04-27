<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        /*
        * Teste para Clientes
        foreach ($retorno_clientes as $row) {
            echo "<p>" . $row->getIdCliente() ." </p>";
            echo "<p>" . $row->getNome() ." </p>";
            echo "<p>" . $row->getCelular() ." </p>";
            echo "<br>";
        }
        */

        /*
        * Teste para Serviços
        foreach ($retorno_servicos as $row) {
            echo "<p>" . $row->getIdServico() ." </p>";
            echo "<p>" . $row->getDescritivo() ." </p>";
            echo "<p>" . $row->getPreco() ." </p>";
            echo "<p>" . $row->getTipo()->getIdTipo() ." </p>";
            echo "<p>" . $row->getTipo()->getDescritivo() ." </p>";
            echo "<br>";
        }
        */

        /*
         * Teste para Agendas
        foreach ($retorno_agendas as $row) {
            echo "<p>" . print_r($row->getIdAgenda()) ." </p>";
            echo "<p>" . print_r($row->getCliente()) ." </p>";
            echo "<p>" . print_r($row->getServico()) ." </p>";
            echo "<p>" . print_r($row->getDataAgenda()) ." </p>";
            echo "<p>" . print_r($row->getHorario()) ." </p>";
            echo "<br>";
        }
        */

        // * Teste para um cliente
        // var_dump($retorno_um_cliente);

        // * Teste para um serviço
        //var_dump($retorno_um_servico);

        // * Teste para uma agenda
        var_dump($retorno_uma_agenda);
    ?>
</body>
</html>