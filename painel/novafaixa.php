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
    <title>Controle SINAN</title>
</head>

<body>
   
    <!-- conteudo -->
    <div class="box">

    <div class="btn-menu">
            <a href="index.php">Voltar</a>
        </div>
     
        <form action="novafaixa.php" method="POST">
            <fieldset>
                <legend><b>NOVA FAIXA</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="inicio" id="inicio" class="inputSemsa" required>
                    <label for="inicio" class="labelInput">Inicío</label>
                </div>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="fim" id="fim" class="inputSemsa" required>
                    <label for="fim" class="labelInput">Fim</label>
                </div>

                <br><br>

                <input type="submit" name="submit" id="submit" value="Salvar">

            </fieldset>

        </form>

    </div>
    <!-- fim conteudo -->

<?php
    if(isset($_POST['submit'])){

        $inicio =  addslashes($_POST['inicio']);
        $fim = addslashes($_POST['fim']);
     

        if(!empty($inicio) && !empty($fim) ){

            $u->conectar("num_sinan","localhost","root","");
            if($u->msgErro == ""){

                if($u->inserirFaixa($inicio, $fim)){
                    ?>
                    <div id=msg-sucesso>
                        Faixa cadastrada com sucesso!
                    </div>
                    
                    <?php

                }
                else{

                    ?>

                        <div class="msg-erro">
                            Faixa já cadastrada!
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