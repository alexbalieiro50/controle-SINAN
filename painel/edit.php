<?php
require_once 'config.php';
$u = new Configuration;
$id = $_GET['id'];
// Variáveis para armazenar os valores dos campos do formulário
$numsinan = $unidade = $cnes = $semana = $lote = $situacao = "";
 
// Verifica se houve uma requisição de atualização
if (isset($_POST['atualizar'])) {
     // Obtenha o ID do registro que será atualizado
    $numsinan = $_POST['NumSinan'];
    $unidade = $_POST['unidade'];
    $cnes = $_POST['cnes'];
    $semana = $_POST['semana'];
    $lote = $_POST['lote'];
    $situacao = $_POST['situacao'];

    // Chama a função de atualização
   
    $atualizado = $u->atualizar($id, $numsinan, $unidade, $cnes, $semana, $lote, $situacao);
    // Verifica se a atualização foi bem-sucedida
    if ($atualizado) {
        ?>
        <div id=msg-sucesso>
            Registro atualizado com sucesso!
        </div>
        <?php
    } else {
        ?>
        <div class="msg-erro">
            Erro ao atualizar o registro.
        </div>
        
        <?php
    }
}

$u->conectar("num_sinan", "localhost", "root", "");
$consulta = $u->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Numeração SINAN</title>
</head>

<body>

    <!-- conteudo -->
    <div class="box">
        <div class="btn-menu">
            <a href="novafaixa.php">+Nova Faixa</a>
            <a href="./painel/lista.php">Listar</a>
        </div>

        <form action="edit.php" method="POST">
            <fieldset>
                <legend><b>Numeração SINAN</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="NumSinan" id="NumSinan" class="inputSemsa" value="<?php echo $numsinan ?>" required>
                    <label for="NumSinan" class="labelInput">Nº SINAN</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="unidade" id="unidade" class="inputSemsa" value="<?php echo $unidade ?>" required>
                    <label for="unidade" class="labelInput">Unidade Notificante</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="cnes" id="cnes" class="inputSemsa" value="<?php echo $cnes ?>" required>
                    <label for="cnes" class="labelInput">CNES da Unidade</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="semana" id="semana" class="inputSemsa" value="<?php echo $semana ?>" required>
                    <label for="semana" class="labelInput">Semana Epidemiológica</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="lote" id="lote" class="inputSemsa" value="<?php echo $lote ?>" required>
                    <label for="lote" class="labelInput">Lote</label>
                </div>

                <br><br>

                <p>Situação:</p>

                <div class="inputRadio">

                    <input type="radio" name="situacao" id="positivo" value="positivo" <?php echo ($situacao == 'positivo') ? 'checked' : '' ?> required>
                    <label for="positivo">Positivo</label>

                    <input type="radio" name="situacao" id="negativo" value="negativo" <?php echo ($situacao == 'negativo') ? 'checked' : '' ?> required>
                    <label for="negativo">Negativo</label>

                </div>

                <br><br>

                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="atualizar" id="submit" value="atualizar">

            </fieldset>

        </form>

    </div>
    <!-- fim conteudo -->

</body>

</html>
