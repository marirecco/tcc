<?php
// Include config file
require_once "config.php";
$date = new DateTime('01-01-2000');
echo $date->format('Y-m-d H:i:s');
 
// Define variables and initialize with empty values
$nome = $data_nasc = $uf = $mail = $senhal = $funcao = $pergunta = $resposta = "";
$nome_err = $data_nasc_err = $uf_err = $mail_err = $senhal_err = $funcao_err = $pergunta_err = $resposta_err = "";
 
// Processing form data when form is submitted


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Por favor, digite seu nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Por favor, digite um nome válido.";
    } else{
        $nome = $input_nome;
    }
    
    // Validate sexo
    // $input_sexo = trim($_POST["sexoaa"]);
    // if(empty($input_sexo)){
    //     $sexo_err = "Por favor, insira sua função.";     
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

    // Validate uf
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

    // Validate senha
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
    if(empty($nome_err) && empty($data_nasc_err) && empty($uf_err) && empty($mail_err) && empty($senhal_err) && empty($funcao_err) && empty($pergunta_err) && empty($resposta_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO usuario (nome, data_nasc, uf, mail, senhal, funcao, pergunta, resposta) VALUES (:nome, :data_nasc, :uf, :mail, :senhal, :funcao, :pergunta, :resposta)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nome", $param_nome);
            // $stmt->bindParam(":sexo", $param_sexo);
            $stmt->bindParam(":data_nasc", $param_data_nasc);
            $stmt->bindParam(":uf", $param_uf);
            $stmt->bindParam(":mail", $param_mail);
            $stmt->bindParam(":senhal", $param_senhal);
            $stmt->bindParam(":funcao", $param_funcao);
            $stmt->bindParam(":pergunta", $param_pergunta);
            $stmt->bindParam(":resposta", $param_resposta);

            // Set parameters
            $param_nome = $nome;
            // $param_sexo = $sexo;
            $param_data_nasc = $data_nasc;
            $param_uf = $uf;
            $param_mail = $mail;
            $param_senhal = $senhal;
            $param_funcao = $funcao;
            $param_pergunta = $pergunta;
            $param_resposta = $resposta;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: entrar.html");
                exit();
            } else{
                echo "Ops! Algo deu errado. Tente novamente mais tarde.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
}
    
    // Close connection
    unset($pdo);

?>