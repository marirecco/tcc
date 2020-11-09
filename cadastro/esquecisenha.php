 <?php 
require_once "conexao.php";

$forget = $_POST['forget'];
$resposta = $_POST['resposta'];
$sql_logar ="SELECT * FROM usuario WHERE forget = '$forget' && resposta = '$resposta'";
$exe_logar = mysqli_query($conection, $sql_logar) or die (mysqli_error());
$fet_logar = mysqli_fetch_assoc($exe_logar);
$num_logar = mysqli_num_rows($exe_logar);

if ($num_logar == 0) {
   echo '<script>alert("Pergunta e/ou resposta incorreta(s), volte e tente novamente.")</script>'; 
} 
else{
   //Cria a sessão e manda pra pagina entrei
   
   $_SESSION['forget'] = $forget;
   $_SESSION['resposta'] = $resposta;
   header("Location: http://localhost/cadastro/entrar.html");
}
   echo "Volte";
  
    ?>  