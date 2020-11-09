<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="bootstrap.css">

    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            font-family: "arial";
            font-size: 1.4rem;  
            font-weight: 300;
            line-height: 2.5;
            margin-top: 1rem;
            margin-bottom: 1rem;
            color: #555;
            text-align: left;
            background-color: #05104E;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" >Minha conta</h2>
                        <!--<a href="create.php" class="btn btn-success pull-right">Cadastrar</a>-->
                    </div>

                    
                    <?php
                    // Include config file
                    require_once "config.php";
                    include "entrar.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM usuario WHERE nome = '$mail'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Código do usuário</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Data de nascimento</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['cod'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['data_nasc'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?cod=". $row['cod'] ."' title='Visualizar cadastro' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?cod=". $row['cod'] ."' title='Alterar cadastro' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?cod=". $row['cod'] ."' title='Excluir cadastro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>Nenhum cadastro realizado.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>