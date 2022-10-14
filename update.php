<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $matriculaErro = null;
    $processoErro = null;
    $raErro = null;
    $lcErro = null;
    $anoterro = null;
    $unierro = null;

    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $processo = $_POST['processo'];
    //$ra = (date('d-m-Y',strtotime($_POST['ra'])));
    //$ra = empty($_POST["ra"]) ? $ra = "" : $ra = (date('d-m-Y',strtotime($_POST['ra'])));
    $data_atual = $_POST['dataatual'];
    //$lc = (date('d-m-Y',strtotime($_POST['lc'])));
    //$lc = empty($_POST["lc"]) ? $lc = "" : $lc = (date('d-m-Y',strtotime($_POST['lc'])));
    $selecao = $_POST['selecao'];
    $anotacoes = $_POST['anotacoes'];
    $unidade = $_POST['unidade'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }
    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE pessoa  set nome = ?, matricula = ?, processo = ?, dataatual = ?, selecao = ?, anotacoes = ?, unidade = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $matricula, $processo, $data_atual, $selecao, $anotacoes, $unidade, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $matricula = $data['matricula'];
    $processo = $data['processo'];
    $data_atual = $data['dataatual'];
    $selecao = $data['selecao'];
    $anotacoes = $data['anotacoes'];
    $unidade = $data['unidade'];
    Banco::desconectar();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <title>Clientes </title>
  </head>
  <body>
    
    <div class="container mt-3">
      <div class="span10 offset1">
          <div class="card">
              <div class="card-header">
                  <h3 class="well"> Atualizar Dados </h3>
              </div>
              <div class="card-body">
                  <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">
  
                      <div class="control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                          <label class="control-label">Nome</label>
                          <div class="controls">
                              <input name="nome" class="form-control" size="50" type="text" placeholder="Nome"
                                     value="<?php echo !empty($nome) ? $nome : ''; ?>">
                              <?php if (!empty($nomeErro)): ?>
                                  <span class="text-danger"><?php echo $nomeErro; ?></span>
                              <?php endif; ?>
                          </div>
                      </div>
  
                      <div class="control-group">
                          <label class="control-label">Matricula</label>
                          <div class="controls">
                              <input name="matricula" class="form-control" size="80" type="text" placeholder="Matricula"
                                     value="<?php echo !empty($matricula) ? $matricula : ''; ?>">
                             
                          </div>
                      </div>
  
                      <div class="control-group >">
                          <label class="control-label">Processo</label>
                          <div class="controls">
                              <input name="processo" class="form-control" size="30" type="text" placeholder="Processo"
                                     value="<?php echo !empty($processo) ? $processo : ''; ?>">
                       
                          </div>
                      </div>




                                            <div class="control-group">
                          <label class="control-label">Unidade Prisional</label>
                          <div class="controls">
                              <input name="unidade" class="form-control" size="30" type="text" placeholder="Unidade Prisional"
                                     value="<?php echo !empty($unidade) ? $unidade : ''; ?>">

                          </div>
                      </div>


  
                      <div class="control-group ">
                          <label class="control-label">Data</label>
                          <div class="controls">
                              <input name="dataatual" class="form-control" size="40" type="date" placeholder=""
                                     value="<?php echo !empty($data_atual) ? $data_atual : ''; ?>">
      
                          </div>
                      </div>
  
  
                <div class="control-group">
                        <label class="control-label">Regime Aberto | Liberdade Condicional</label>
                        <div class="controls">
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="selecao" id="selecao"
                                           value="Regime Aberto" <?php echo ($selecao == "Regime Aberto") ? "checked" : null; ?>/> Regime Aberto
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selecao" id="selecao"
                                       value="Liberdade Condicional" <?php echo ($selecao == "Liberdade Condicional") ? "checked" : null; ?>/> Liberdade Condicional
                            </div>
                            </p>
                           
                        </div>
                    </div>
  
  
             <div class="mb-3">
    <label for="" class="form-label">Anotações</label>
    <textarea class="form-control" id="" name="anotacoes" rows="5"> <?php echo $data['anotacoes']; ?> </textarea>
  
  
  </div>
  
  
  
  
                      <br/>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-warning">Atualizar</button>
                          <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
