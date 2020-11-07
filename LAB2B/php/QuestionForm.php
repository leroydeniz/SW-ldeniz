<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <h2>Crear pregunta sin imagen</h2><br/><br/>
        <form id='fquestion' name='fquestion' action='AddQuestion.php' method='post' onsubmit='return validate_form();'><center>
            <table>
                <tr>
                    <td>
                        Email (*):
                    </td>
                    <td>
                        <input type="text" name="email" id="email" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Enunciado de la pregunta (*):
                    </td>
                    <td>
                        <input type="text" name="enunciado" id="enunciado" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta correcta (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_correcta" id="respuesta_correcta" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 1 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal1" id="respuesta_mal1" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 2 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal2" id="respuesta_mal2" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 3 (*):
                    </td>
                    <td>
                        <input type="text" name="respuesta_mal3" id="respuesta_mal3" size="60">
                    </td>
                </tr>
                <tr>
                    <td>
                        Complejidad (*):
                    </td>
                    <td>
                        <select name="complejidad" id="complejidad" style="width:100%;">
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
                        <input type="text" name="tema" id="tema" size="60">
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