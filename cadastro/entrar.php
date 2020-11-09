    <?php 
require_once "conexao.php";

$mail = $_POST['mail'];
$senhal = $_POST['senhal'];
$sql_logar ="SELECT * FROM usuario WHERE mail = '$mail' && senhal = '$senhal'";
$exe_logar = mysqli_query($conection, $sql_logar) or die (mysqli_error());
$fet_logar = mysqli_fetch_assoc($exe_logar);
$num_logar = mysqli_num_rows($exe_logar);

if ($num_logar == 0) {
   echo '<script>alert("E-mail e/ou senha incorreto(s), volte e tente novamente.")</script>'; 
} 
else{
   //Cria a sessão e manda pra pagina entrei
   
   $_SESSION['mail'] = $mail;
   $_SESSION['senhal'] = $senhal;
   header("Location: http://localhost/entrei/logado/");
}
   echo "Volte";
  
    ?>  