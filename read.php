<?php
require 'banco.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
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
    <title>Clientes  </title>
  </head>
  <body>
    

    <body>
      <div class="container mt-5">
          <div class="span10 offset1">
              <div class="card">
                  <div class="card-header">
                      <h3 class="well">Informações</h3>
                  </div>
                  <div class="container">
                      <div class="form-horizontal">
                          <div class="control-group">
                              <label class="control-label">Nome</label>
                              <div class="controls form-control">
                                  <label class="carousel-inner">
                                      <?php echo $data['nome']; ?>
                                  </label>
                              </div>
                          </div>
      
                          <div class="control-group">
                              <label class="control-label">Matricula</label>
                              <div class="controls form-control disabled">
                                  <label class="carousel-inner">
                                      <?php echo $data['matricula']; ?>
                                  </label>
                              </div>
                          </div>
      
                          <div class="control-group">
                              <label class="control-label">Processo</label>
                              <div class="controls form-control disabled">
                                  <label class="carousel-inner">
                                      <?php echo $data['processo']; ?>
                                  </label>
                              </div>
                          </div>
                          <div class="control-group">
                              <label class="control-label">Unidade Prisional</label>
                              <div class="controls form-control disabled">
                                  <label class="carousel-inner">
                                      <?php echo $data['unidade']; ?>
                                  </label>
                              </div>
                          </div>
      
                          <div class="control-group">
                              <label class="control-label">Data</label>
                              <div class="controls form-control disabled">
                                  <label class="carousel-inner">
                                      <?php 
                                      echo $date = date('d-m-Y', strtotime( $data['dataatual'] )); 
                                      ?>
                                                  
                                  </label>
                              </div>
                          </div>
                          <div class="control-group">
                              <label class="control-label">Regime Aberto | Liberdade Condicional</label>
                              <div class="controls form-control disabled">
                                  <label class="carousel-inner">
                                      <?php echo $data['selecao']; ?>
                                  </label>
                              </div>
                          </div>
    
                 <div class="mb-3">
        <label for="" class="form-label">Anotações</label>
        <textarea class="form-control" id="" name="anotacoes" rows="5"> <?php echo $data['anotacoes']; ?> </textarea>
      </div>
                          <br/>
                          <div class="form-actions">
                              <a href="index.php" type="btn" class="btn btn-link mb-2"> << Voltar</a>
                          </div>
                      </div>
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
