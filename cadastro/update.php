<?php
// Include config file
require_once "config.php";
$date = new DateTime('01-01-2000');
 
// Define variables and initialize with empty values
$nome =  $data_nasc = $uf = $mail = $senhal = $funcao = $pergunta_err = $resposta_err = "";
$nome_err =  $data_nasc_err = $uf_err = $mail_err = $senhal_err = $funcao_err = $pergunta_err = $resposta_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["cod"]) && !empty($_POST["cod"])){
    // Get hidden input value
    $cod = $_POST["cod"];
    
    // Validate nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Por favor, digite seu nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Por favor, digite um nome válido.";
    } else{
        $nome = $input_nome;
    }
    
    // Valate sexo
    // $input_sexo = trim($_POST["sexo"]);
    // if(empty($input_sexo)){
    //     $sexo_err = "Por favor, informe seu sexo.";     
    // } else{
    //     $sexo = $input_sexo;
    // }
    
    // Validate data de nascimento
    $input_data_nasc = trim($_POST["data_nasc"]);
    if(empty($input_data_nasc)){
        $data_nasc_err = "Por favor, digite sua data de nascimento.";     
    } else{
        $data_nasc = $input_data_nasc;
    }

    //validação UF
    $input_uf = trim($_POST["uf"]);
    if(empty($input_uf)){
        $uf_err = "Por favor, insira seu estado.";     
    } else{
        $uf = $input_uf;
    }

    // Validate email
    $input_mail = trim($_POST["mail"]);
    if(empty($input_mail)){
        $mail_err = "Por favor, insira seu e-mail.";     
    } else{
        $mail = $input_mail;
    }

    //validate senha
    $input_senhal = trim($_POST["senhal"]);
    if(empty($input_senhal)){
        $senhal_err = "Por favor, insira sua senha.";     
    } else{
        $senhal = $input_senhal;
    }

    // Validate função
    $input_funcao = trim($_POST["funcao"]);
    if(empty($input_funcao)){
        $funcao_err = "Por favor, insira sua função.";     
    } else{
        $funcao = $input_funcao;
    }

    // Validate pergunta
    $input_pergunta = trim($_POST["pergunta"]);
    if(empty($input_pergunta)){
        $pergunta_err = "Por favor, escolha uma pergunta.";     
    } else{
        $pergunta = $input_pergunta;
    }

    // Validate resposta
    $input_resposta = trim($_POST["resposta"]);
    if(empty($input_resposta)){
        $resposta_err = "Por favor, digite sua resposta.";     
    } else{
        $resposta = $input_resposta;
    }
    
    // Check input errors before inserting in database
    if(empty($nome_err)  && empty($data_nasc_err) && empty($uf_err) && empty($mail_err) && empty($senhal_err) && empty($funcao_err) && empty($pergunta_err) && empty($resposta_err)){
        // Prepare AIan update statement
       $sql = "UPDATE usuario SET nome=:nome, data_nasc=:data_nasc, uf=:uf, mail=:mail, senhal=:senhal, funcao=:funcao, pergunta=:pergunta, resposta=:resposta WHERE cod=:cod";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nome", $param_nome);
            $stmt->bindParam(":data_nasc", $param_data_nasc);
            $stmt->bindParam(":uf", $param_uf);
            $stmt->bindParam(":mail", $param_mail);
            $stmt->bindParam(":senhal", $param_senhal);
            $stmt->bindParam(":funcao", $param_funcao);
            $stmt->bindParam(":pergunta", $param_pergunta);
            $stmt->bindParam(":resposta", $param_resposta);
            $stmt->bindParam(":cod", $param_cod);
            
            // Set parameters
            $param_nome = $nome;
            $param_data_nasc = $data_nasc;
            $param_uf = $uf;
            $param_mail = $mail;
            $param_senhal = $senhal;
            $param_funcao = $funcao;
            $param_pergunta = $pergunta;
            $param_resposta = $resposta;
            $param_cod = $cod;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["cod"]) && !empty(trim($_GET["cod"]))){
        // Get URL parameter
        $cod =  trim($_GET["cod"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM usuario WHERE cod = :cod";
                if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":cod", $param_cod);
            
            // Set parameters
            $param_cod = $cod;
            
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
                    $resposta = $row["resposta"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar cadastro</title>
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
                        <h2>Editar cadastro</h2>
                    </div>
                    <p>Edite os valores de entrada e envie para atualizar o registro.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>

                        <!-- <div class="form-group <?php echo (!empty($sexo_err)) ? 'has-error' : ''; ?>">
                            <label>Sexo</label>
                            <br>
                            <select name="sexo">
                            <option value="0">Feminino</option>
                            <option value="1">Masculino</option>
                            </select> 
                            <span class="help-block"><?php echo $sexo_err;?></span>
                        </div> -->

                        <div class="form-group <?php echo (!empty($data_nasc_err)) ? 'has-error' : ''; ?>">
                            <label>Data de Nascimento</label>
                            <input type="date" name="data_nasc" class="form-control" value="<?php echo $data_nasc; ?>">
                            <span class="help-block"><?php echo $data_nasc_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>UF</label>
                            <br>
                            <select name="uf">
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Acre (AC)")?>>Acre (AC)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Alagoas (AL)") echo "selected";?>>Alagoas (AL)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Amapá (AP)") echo "selected";?>>Amapá (AP)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Amazonas (AM)") echo "selected";?>>Amazonas (AM)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Bahia (BA)")?>>Bahia (BA)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Ceará (CE)")?>>Ceará (CE)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Distrito Federal (DF)")?>>Distrito Federal (DF)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Espírito Santo (ES)")?>>Espírito Santo (ES)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Goiás (GO)")?>>Goiás (GO)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Maranhão (MA)")?>>Maranhão (MA)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Mato Grosso (MT)")?>>Mato Grosso do Sul (MS)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Minas Gerais (MG)")?>>Minas Gerais (MG)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Pará (PA)")?>>Pará (PA)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Paraíba (PB)")?>>Paraíba (PB)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Paraná (PR)")?>>Paraná (PR)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Pernambuco (PE)")?>>Pernambuco (PE)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Piauí (PI)")?>>Piauí (PI)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Rio de Janeiro (RJ)")?>>Rio de Janeiro (RJ)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Rio Grande do Norte (RN)")?>>Rio Grande do Norte (RN)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Rio Grande do Sul (RS)")?>>Rio Grande do Sul (RS)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Rondônia (RO)")?>>Rondônia (RO)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Roraima (RR)")?>>Roraima (RR)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Santa Catarina (SC)")?>>Santa Catarina (SC)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "São Paulo (SP)")?>>São Paulo (SP)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Sergipe (SE)")?>>Sergipe (SE)</option>
                            <option <?php if(isset($_POST["uf"]) && $_POST["uf"] == "Tocantins (TO)")?>>Tocantins (TO)</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        

                        <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <input type="text" name="mail" class="form-control"
                            value="<?php echo $mail; ?>">
                            <span class="help-block"><?php echo $mail_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($senhal_err)) ? 'has-error' : ''; ?>">
                            <label>Senha</label>
                            <input type="text" name="senhal" class="form-control"
                            value="<?php echo $senhal; ?>">
                            <span class="help-block"><?php echo $senhal_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($funcao_err)) ? 'has-error' : ''; ?>">
                            <label>Função</label>
                            <br>
                            <select name="funcao">
                              <option value="1">Professor</option>
                              <option value="2">Aluno</option>
                              <option value="3">Visitante</option>
                              <option value="4">Outros</option>
                            </select>
                           <!--  <span class="help-block"><?php echo $sexo_err;?></span> -->
                        </div>

                        <div class="form-group <?php echo (!empty($pergunta_err)) ? 'has-error' : ''; ?>">
                            <label>Pergunta</label>
                            <br>
                            <select name="pergunta">
                              <option value="1">Qual o nome do primeiro animal de estimação?</option>
                              <option value="2">Qual o nome do primeiro amor?</option>
                              <option value="3">Qual o nome do pai?</option>
                              <option value="4">Qual o nome da mãe?</option>
                              <option value="5">Qual o nome do professor(a) favorito(a)?</option>
                              <option value="6">Qual o nome da banda/grupo musical favorito?</option>
                            </select>
                            <span class="help-block"><?php echo $pergunta_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($senhal_err)) ? 'has-error' : ''; ?>">
                            <label>Resposta</label>
                            <input type="text" name="resposta" class="form-control"
                            value="<?php echo $resposta; ?>">
                            <span class="help-block"><?php echo $resposta_err;?></span>
                        </div>

                        <input type="hidden" name="cod" value="<?php echo $cod; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>