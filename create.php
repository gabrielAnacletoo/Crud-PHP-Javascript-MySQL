

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $matriculaErro = null;
    $processoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }


        if (!empty($_POST['matricula'])) {
            $matricula = $_POST['matricula'];
        } else {
            $matriculaErro = 'Por favor digite o seu endereço!';
            $validacao = False;
        }

$processo = $_POST['processo'];
//$email = (date('d-m-Y',strtotime($_POST['email'])));
//$ra = empty($_POST["ra"]) ? $ra = "" : $ra = $_POST['ra'];  
$data_atual = $_POST['dataatual'];
//$raformat = (date('d-m-Y',strtotime($_POST['ra'])));
//$sexo = (date('d-m-Y',strtotime($_POST['sexo'])));
//$lc = $_POST["lc"];
$selecao = $_POST['selecao'];
//$lc = empty($_POST["lc"]) ? $lc = "" : $lc = $_POST['lc'];  
$anotacoes = $_POST['anotacoes'];
$unidade = $_POST['unidade'];

    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pessoa (nome, matricula, processo, dataatual, selecao, anotacoes, unidade) VALUES(?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $matricula, $processo, $data_atual, $selecao, $anotacoes, $unidade));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<link rel="stylesheet" href="style.css">
<title> Cadastrar novos clientes </title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Nome </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" autocomplete="off" action="create.php" method="post">

                    <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                                   value="">
                        
                        </div>
                    </div>

                    <div class="control-group ">
                        <label class="control-label">matricula</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="matricula" type="text" placeholder="matricula"
                                   value="">

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Processo</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="processo" type="text" placeholder="Processo"
                                   value="">
                 
                        </div>
                    </div>



                            <div class="control-group">
                        <label class="control-label">Unidade Prisional</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="unidade" type="text" placeholder="Exemplo: P1 OU P2"
                                   value="<?php echo !empty($unidade) ? $unidade : ''; ?>">
                           
                        </div>
                    </div>



                    <div class="control-group ">
                        <label class="control-label">Data</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="dataatual" type="date" placeholder=""
                                   value="">
                        </div>
                    </div>
                    
                        <div class="control-group">
                        <div class="controls">
                            <!-- <input size="40" class="form-control" name="rglc" type="date" placeholder=""> -->
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selecao" id="" value="Regime Aberto">
                            <label class="form-check-label" for="">Regime Aberto</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selecao" id="" value="Liberdade Condicional">
                            <label class="form-check-label" for="">Liberdade Condicional</label>
                            </div>

                        </div>
                    </div>
         
           <div class="mb-3">
  <label for="" class="form-label">Anotações</label>
  <textarea class="form-control" id="" name="anotacoes" rows="5"></textarea>
</div>

                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

