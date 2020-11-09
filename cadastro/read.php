<?php
// Check existence of id parameter before processing further
if(isset($_GET["cod"]) && !empty(trim($_GET["cod"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM usuario WHERE cod = :cod";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":cod", $param_cod);
        
        // Set parameters
        $param_cod = trim($_GET["cod"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $nome = $row["nome"];
                // $sexo = $row["sexo"];
                $data_nasc = $row["data_nasc"];
                $uf = $row["uf"];
                $mail = $row["mail"];
                $senhal = $row["senhal"];
                $funcao = $row["funcao"];
                $pergunta = $row["pergunta"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizar cadastro</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Visualizar cadastro</h1>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <p class="form-control-static"><?php echo $row["nome"]; ?></p>
                    </div>

                    <!-- <div class="form-group">
                        <label>Sexo</label>
                        <p class="form-control-static"><?php echo $row["sexo"]; ?></p>
                    </div> -->

                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <p class="form-control-static"><?php echo $row["data_nasc"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>UF</label>
                        <p class="form-control-static"><?php echo $row["uf"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <p class="form-control-static"><?php echo $row["mail"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <p class="form-control-static"><?php echo $row["senhal"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Função</label>
                        <p class="form-control-static"><?php echo $row["funcao"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Pergunta</label>
                        <p class="form-control-static"><?php echo $row["pergunta"]; ?></p>
                    </div>

                    <div class="form-group"
                        <b><label>Resposta</label></b>
                        <p class="form-control-static"><?php echo $row["resposta"]; ?></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>