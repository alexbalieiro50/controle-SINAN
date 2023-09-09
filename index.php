<?php
    require_once './painel/config.php';
    $u = new Configuration;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Numeração SINAN</title>
</head>

<body>

    <!-- conteudo -->
    <div class="box">
        <div class="btn-menu">
            <a href="novafaixa.php">+Nova Faixa</a>
            <a href="./painel/lista.php">Listar</a>
        </div>

        <form action="index.php" method="POST">
            <fieldset>
                <legend><b>Numeração SINAN</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="NumSinan" id="NumSinan" class="inputSemsa" required>
                    <label for="NumSinan" class="labelInput">Nº SINAN</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="unidade" id="unidade" class="inputSemsa" required>
                    <label for="unidade" class="labelInput">Unidade Notificante</label>
                    <!--
                    <select name="unidade" required="required">
                        <option value="">Escolha a Unidade Notificadora</option>
                        <option value="altina">UBS ALTINA GONÇALVES</option>
                        <option value="sergio">UBS SERGIO PEREIRA PESSOA</option>
                        <option value="nova_italia">POLO BASE NOVA ITÁLIA</option>
                        <option value="sao_fcanimari">POLO BASE SÃO FRANCISCO DO CANIMARI</option>
                        <option value="irmaos_ramires">UBS IRMÃOS RAMIRES</option>
                    </select>
                    -->
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="cnes" id="cnes" class="inputSemsa" required>
                    <label for="cnes" class="labelInput">CNES da Unidade</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="semana" id="semana" class="inputSemsa" required>
                    <label for="semana" class="labelInput">Semana Epidemiológica</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="lote" id="lote" class="inputSemsa" required>
                    <label for="lote" class="labelInput">Lote</label>
                </div>

                <br><br>

                <p>Situação:</p>

                <div class="inputRadio">

                    <input type="radio" name="situacao" id="positivo" value="positivo" require>
                    <label for="positivo">Positivo</label>

                    <input type="radio" name="situacao" id="negativo" value="negativo" require>
                    <label for="negativo">Negativo</label>

                </div>

                <br><br>


                <input type="submit" name="submit" id="submit" value="Salvar">

            </fieldset>

        </form>

    </div>
    <!-- fim conteudo -->

    <?php
    if(isset($_POST['submit'])){

        $numsinan =  addslashes($_POST['NumSinan']);
        $unidade = addslashes($_POST['unidade']);
        $cnes = addslashes($_POST['cnes']);
        $semana = addslashes($_POST['semana']);
        $lote = addslashes($_POST['lote']);
        $situacao = addslashes($_POST['situacao']);

        if(!empty($numsinan) && !empty($unidade) && !empty($cnes) && !empty($semana) && !empty($lote) && !empty($situacao)){

            $u->conectar("num_sinan","localhost","root","");
            if($u->msgErro == ""){

                if($u->inserir($numsinan, $unidade, $cnes, $semana,$lote, $situacao)){
                    ?>
                    <div id=msg-sucesso>
                        Cadastrado com sucesso!
                    </div>
                    
                    <?php

                }
                else{

                    ?>

                        <div class="msg-erro">
                            Unidade já cadastrada para a semana!
                        </div>
                   
                    <?php

                }

            }
            else{

                ?>

                    <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro; ?>
                    </div>

                <?php           

            }

        }
        else{

            ?>

                <div class="msg-erro">
                    Preencha todos os campos!
                </div>

                   
            <?php
        }
   
    }
?>


</body>

</html>