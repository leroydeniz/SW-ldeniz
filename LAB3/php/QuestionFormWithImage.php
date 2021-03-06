<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
</head>
<body>
  
  <?php
    if(isset($_GET['email'])){
        include "../php/Menus-registrado.php";
    } else {
        include "../php/Menus.php";
    }
    
  if(isset($_GET['email'])){
      $email = $_GET['email'];
  }
  ?> 
  <section class="main" id="s1">
    <div>
        <h2>Crear pregunta</h2><br/><br/>
        <form id='fquestion' name='fquestion' action='AddQuestionWithImage.php' method="POST" enctype='multipart/form-data'><center>
            <table>
                <input id="email" name="email" type="hidden" value="<?php echo $email; ?>">
                <tr>
                    <td>
                        Email (*):
                    </td>
                    <td>
                        <input type="text" value="<?php echo $email;?>" name="emailform" id="emailform" size="60" style="background-color:#bbbbbb;" readonly >
                    </td>
                    <td rowspan="9">
                        <img id="output" src="" style="max-width:250px;margin-left:20px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        Enunciado de la pregunta (*):
                    </td>
                    <td>
                        <input type="text" name="enunciado" id="enunciado" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta correcta (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_correcta" id="respuesta_correcta" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 1 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal1" id="respuesta_mal1" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 2 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal2" id="respuesta_mal2" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 3 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal3" id="respuesta_mal3" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Complejidad (*):
                    </td>
                    <td>
                        <select id="complejidad" name="complejidad" style="width:100%;" >
                            <option value="1">Baja</option>
                            <option value="2">Media</option>
                            <option value="3">Alta</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tema de la pregunta (*):
                    </td>
                    <td>
                        <input type="text" name="tema" id="tema" size="60" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Imagen relacionada:
                    </td>
                    <td>
                        <input type="file" name="imgInp" id="imgInp" size="30" accept="image/png,image/gif,image/jpeg, image/svg, image/jpg"  onchange="loadFile(event)">
                    </td>
                </tr>
            </table>
            </center>
            <br/><br/><input type="submit" id="submit" value="Enviar solicitud"><input type="reset" value="Borrar">
        </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  
</body>
</html>