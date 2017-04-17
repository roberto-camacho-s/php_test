<!DOCTYPE html>
<?php 
    class ChangeString {
        function build($texto) {
            // IMPORTANTE: para reconocimiento de textos con ñ o Ñ cambiar a líneas "mb_" (Multibyte)
            // depende de extensión Multibyte habilitada
            $encoding = "UTF-8";
            $nuevo_texto = "";
            $abecedario = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
            $nuevo_abecedario = "bcdefghijklmnñopqrstuvwxyzaBCDEFGHIJKLMNÑOPQRSTUVWXYZA";
            for ($i = 0; $i <= strlen($texto) - 1; $i++) {
//                // líneas mb_
//                $letra = mb_substr($texto, $i, 1, $encoding);
//                if (mb_strpos($abecedario, $letra, 0, $encoding) !== false) {
//                    $letra = mb_substr($nuevo_abecedario, mb_strpos($abecedario, $letra, 0, $encoding), 1, $encoding);
//                }
                $letra = substr($texto, $i, 1);
                if (strpos($abecedario, $letra) !== false) {
                    $letra = substr($nuevo_abecedario, strpos($abecedario, $letra), 1);
                }
                $nuevo_texto .= $letra;
            }
            return $nuevo_texto;
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Problema 01</title>
    </head>
    <body>
        <?php
            error_reporting(E_ERROR | E_PARSE);
            $change_string = new ChangeString();
            echo $change_string->build("123 abcd*3")."<br />"; //123 bcde*3
            echo $change_string->build("**Casa 52")."<br />"; //**Dbtb 52
            echo $change_string->build("**Casa 52Z")."<br />"; //**Dbtb 52A
            echo $change_string->build("Mañana 2017Z")."<br />"; //Nbobñb 2017A con funciones mb_ activas
        ?>
    </body>
</html>
