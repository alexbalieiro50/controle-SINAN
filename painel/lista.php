<?php
require_once 'config.php';
$u = new Configuration;    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Numeração SINAN</title>
    <script src="https://kit.fontawesome.com/073810b3bf.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- conteudo -->
    <div class="table-bg">
        <table class="table-mg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero SINAN</th>
                    <th scope="col">Unidade Notificante</th>
                    <th scope="col">CNES da Unidade</th>
                    <th scope="col">Semana Epidemiológica</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Situação</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u->conectar("num_sinan", "localhost", "root", "");
                $dados = $u->listar();
                foreach ($dados as $data) {
                    echo "<tr>";
                    echo "<td>".$data['id']."</td>";
                    echo "<td>".$data['numero']."</td>";
                    echo "<td>".$data['unidade']."</td>";
                    echo "<td>".$data['cnes']."</td>";
                    echo "<td>".$data['semana_epidemiologica']."</td>";
                    echo "<td>".$data['lote']."</td>";
                    echo "<td>".$data['situacao']."</td>";
                    echo "<td> <a class='btn' href='edit.php?id=$data[id]'><i class='fa-solid fa-pencil'></i></a></td>";
                    echo "<td> <a class='btn' href='#'><i class='fa-solid fa-trash-can'></i></i></a></td>";
                    // Adicione aqui as outras colunas que deseja exibir
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
