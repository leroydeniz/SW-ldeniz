<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">


<html>
    <body>
    <center>
    <br/><br/><h1>Vista de Questions.xml</h1><br/><br/>
        <table border="1" width="90%">
            <thead><tr style="padding:25px;background-color:#009900;"> <th style="padding:25px;">Autor</th> <th style="padding:25px;">Enunciado</th> <th style="padding:25px;">Respuesta Correcta</th> <th style="padding:25px;">Respuestas Incorrectas</th> <th style="padding:25px;">Tema</th> </tr></thead>
            <xsl:for-each select="/assessmentItems/assessmentItem">
            
            <tr>
            
                <td style="padding:25px;"> <xsl:value-of select="@author"/> </td>
                <td style="padding:25px;"> <xsl:value-of select="itemBody/p"/> </td>
                <td style="padding:25px;"> <xsl:value-of select="correctResponse/response"/> </td>
                <td style="padding:25px;"> <xsl:for-each select="incorrectResponses/response"><li><xsl:value-of select="node()"/></li></xsl:for-each> </td>
                <td style="padding:25px;"> <xsl:value-of select="@subject"/> </td>
                
            </tr>

        </xsl:for-each>
        </table>
        </center>
    </body>
</html>


</xsl:template>
</xsl:stylesheet>