<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dados Pessoais</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            font-family: "arial";
            font-size: 2.08rem;
            font-weight: 400;
            line-height: 2.5;
            margin-top: 1rem;
            margin-bottom: 1rem;
            color: white;
            text-align: left;   
            background-color: #05104E;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        

                        <h2>Dados Pessoais</h2>
                    </div>
                    <form action="cadastro.php" method="post">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control" value="" required placeholder="Ex: João de Souza">
                            <span class="help-block"></span>
                        </div>

                     <!--   <span class="">Sexo</span>
                                        <div class="row">
                                            <div class="col-12">
                                                <label style="padding:0px 20px;" for="defaultRadio1">Masculino  <input  name="sexo" type="radio" required value="M" id="defaultRadio1"></label>
                                                <label for="defaultRadio1">Feminino <input name="sexo" type="radio"  required value="F" id="defaultRadio2"></label>
                                            </div>
                                        </div> -->

                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <input type="date" name="data_nasc" class="form-control"
                            value="">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label>UF:</label>
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

                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" name="mail" class="form-control"
                            value="" required placeholder="Ex: joaodesouza@gmail.com">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senhal" class="form-control"
                            value="">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label>Função:</label>
                            <br>
                            <select name="funcao">
                              <option value="1">Professor</option>
                              <option value="2">Aluno</option>
                              <option value="3">Visitante</option>
                              <option value="4">Outros</option>
                            </select>
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label>Pergunta:</label>
                            <br>
                            <select name="pergunta">
                              <option value="1">Qual o nome do primeiro animal de estimação?</option>
                              <option value="2">Qual o nome do primeiro amor?</option>
                              <option value="3">Qual o nome do pai?</option>
                              <option value="4">Qual o nome da mãe?</option>
                              <option value="5">Qual o nome do professor(a) favorito(a)?</option>
                              <option value="6">Qual o nome da banda/grupo musical favorito?</option>
                            </select>
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label>Resposta:</label>
                            <input type="text" name="resposta" class="form-control"
                            value="">
                            <span class="help-block"></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="http://localhost/Plataforma_Expert/startbootstrap-freelancer-gh-pages/#" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>