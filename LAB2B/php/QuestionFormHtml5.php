<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script>
        var allok = $("fquestion").click("submit",validate_form());
        if (!allok) {
            e.preventDefault();
        }
    </script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <h2>Crear pregunta sin imagen en HTML5</h2><br/><br/>
        <form id='fquestion' name='fquestion' action='AddQuestion.php' method="POST"  onsubmit="return validate_form();"><center>
            <table>
                <tr>
                    <td>
                        Email (*):
                    </td>
                    <td>
                        <input type="email" id="email" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Enunciado de la pregunta (*):
                    </td>
                    <td>
                        <input type="text" id="enunciado" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta correcta (*):
                    </td>
                    <td>
                        <input type="text" id="respuesta_correcta" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 1 (*):
                    </td>
                    <td>
                        <input type="text" id="respuesta_mal1" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 2 (*):
                    </td>
                    <td>
                        <input type="text" id="respuesta_mal2" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Respuesta incorrecta 3 (*):
                    </td>
                    <td>
                        <input type="text" id="respuesta_mal3" size="60" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Complejidad (*):
                    </td>
                    <td>
                        <select id="complejidad" style="width:100%;" required>
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
                        <input type="text" id="tema" size="60" required>
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