<?php
include('./login/session.php');
if(!isset($_SESSION['login_user'])){
header("location: ./login/index.php"); // Redireciona para index caso não tenha sessão 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <!-- sortable -->
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"> </script> 
<title>Clientes </title>
  </head>
  <body>  
<div class="container"><!-- COMEÇO DO NAVBAR -->
<nav class="navbar navbar-expand-md bg-light fixed-top fs-5">
        <div class="dropdown">
          <button class="btn btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item">Usuaria : <?php echo $_SESSION['login_user']; ?> <img src="./img/menina.png"  style="width:35px;heigth:30px;"></a><hr>
            <a class="dropdown-item"> <?php date_default_timezone_set('America/Sao_Paulo'); $datee = date('d/m/Y H:i'); echo $datee; ?> <img src="./img/relogio.png"  style="width:35px;heigth:30px"></a><hr>
           <a class="dropdown-item" href="create.php">Adicionar Cliente <img src="./img/mais.png" style="width:35px;heigth:30px;"> </a><hr>
          <a class="dropdown-item" href="./login/logout.php">Sair <img src="./img/sair.png"  style="width:35px;heigth:30px;"></a>
         </div>
        </div>
      </nav>         
 </div>  <!-- FIM DO NAVBAR -->     
<!-- ============================ COMEÇO DA TABELA ============================ -->
                <div class="container-fluid">
                 <div class="card shadow-lg">
                 <div class="card-body">
<!--============================== LOGO ============================== -->
<center><img src="./img/bg2.png" style="width:650px;heigth:400px;" class="mt-4"><br></center>
<!--============================== LOGO ============================== -->
                 <div class="table-responsive">
                  <div class="input-group mb-2">
                  <span class="input-group-text" id="inputGroup-sizing-sm"><img src="./img/lupa.png" style="width:34px;"></span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="filtro-nome" placeholder="Pesquisar" autocomplete="off"> 
                  <table id="myTable" class="table table-striped table-hover responsive  sortable">
                 <thead>
                  <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Matricula</th>
                  <th scope="col">Processo</th>
                  <th scope="col" class="col-1" >Unidade Prisional</th>
                  <th scope="col" class="col-1 ">Data</th>
                  <th scope="col" class="col-2">Regime Aberto | Liberdade  Condicional</th>
                  <th scope="col" class="col-2">Anotações</th>
                  <th scope="col-1">Ações</th> 
              </tr>
          </thead>
          <tbody>
              <?php
              include 'banco.php';
              $pdo = Banco::conectar();
              $sql = 'SELECT * FROM pessoa ORDER BY dataatual ASC'; 
              foreach($pdo->query($sql)as $row)
              {
                  echo '<tr>';
                  //echo '<th scope="row">'. $row['id'] . '</th>';
                  echo '<td>'. $row['nome'] . '</td>';
                  echo '<td>'. $row['matricula'] . '</td>';
                  echo '<td>'. $row['processo'] . '</td>';
                  echo '<td>'. $row['unidade'] . '</td>';
                  //echo '<td>'. date_format($row['ra'],"d/m/Y");
                  //echo '<td>'. $row['ra'] . '</td>';
                  echo '<td>'. $date = date('d-m-Y', strtotime( $row['dataatual'] ));
                  echo '<td>'. $row['selecao'] . '</td>';
                  //echo '<td>'. $datelc = date('d-m-Y', strtotime( $row['lc'] ));
                  echo '<td>'. $row['anotacoes'] . '</td>';
                  echo '<td width=250>';
                  echo '<a href="read.php?id='.$row['id'].'"><img src="./img/em-formacao.png" style="width:37px;margin-left:1px;" title="Informações">  ';
                  //echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                  echo ' ';
                  echo '<a href="update.php?id='.$row['id'].'"><img src="./img/editar-codigo.png" style="width:39px;margin-left:3px;margin-top:2px;" title="Editar">  ';
                  //echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Editar</a>';
                  echo ' ';
                  echo '<a href="delete.php?id='.$row['id'].'"><img src="./img/bin.png" style="width:37px;margin-left:1px;" title="Excluir">  ';
                  //echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                  echo '</td>';
                  echo '</tr>';
              }
              Banco::desconectar();
              ?>
                      </tbody>
                  </table>
               </div>
            </div>
         </div>
   </div>
</div>
<!-- ============================== COMEÇO DA TABELA ============================== -->
<!--  ============================== javascript internos ============================== -->
<script src="./js/paginacao.js"></script> 
<script> /* ======================= JS DE PESQUISA ======================= */
        var filtro = document.getElementById('filtro-nome');
          var tabela = document.getElementById('myTable');
            filtro.onkeyup = function() {
                var nomeFiltro = filtro.value;
                for (var i = 1; i < tabela.rows.length; i++) {
            var conteudoCelula = tabela.rows[i].cells[0].innerText;
        var corresponde = conteudoCelula.toLowerCase().indexOf(nomeFiltro) >= 0;
      tabela.rows[i].style.display = corresponde ? '' : 'none';
   }
};
/* ======================= JS DE PESQUISA ======================= */
</script> 

<!-- javascript internos -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
