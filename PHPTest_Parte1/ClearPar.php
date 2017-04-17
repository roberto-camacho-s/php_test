<!DOCTYPE html>
<?php 
    class ClearPar {
        function build($parentesis) {
            $parentesis_validos = str_pad(" ", strlen($parentesis));  // cadena que irá mostrando los paréntesis bien definidos
            $parentesis_cerrados = str_replace("(", " ", $parentesis); // paréntesis de cierre disponibles
            $apariciones_abierto = substr_count($parentesis, "(");
            $tope_abierto = 0;
            for ($i = 1; $i <= $apariciones_abierto; $i++) { // recorre los paréntesis abiertos
                $posicion_abierto = strrpos($parentesis, "(", $tope_abierto);
                $tope_abierto = $posicion_abierto - (strlen($parentesis) + 1);
                $posicion_cerrado = strpos($parentesis_cerrados, ")", $posicion_abierto + 1); // busca el paréntesis que corresponda para el paréntesis abierto
                if ($posicion_cerrado > 0) {
                    $parentesis_cerrados = substr_replace($parentesis_cerrados, " ", $posicion_cerrado, 1); // quita el paréntesis de cierre de los disponibles
                    $parentesis_validos = substr_replace($parentesis_validos, "(", $posicion_abierto, 1); // muestra el paréntesis abierto bien definido
                    $parentesis_validos = substr_replace($parentesis_validos, ")", $posicion_cerrado, 1); // muestra el paréntesis cerrado bien definido
                }
            }
            return str_replace(" ", "", $parentesis_validos);
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Problema 03</title>
    </head>
    <body>
        <?php
            $clear_par = new ClearPar();
            echo $clear_par->build("()())()")."<br />"; //()()()
            echo $clear_par->build("()(()")."<br />"; //()()
            echo $clear_par->build(")(")."<br />"; //
            echo $clear_par->build("((()")."<br />"; //()
            echo $clear_par->build("(((()))(")."<br />"; //((()))
            echo $clear_par->build(")((())(()")."<br />"; //(())()
        ?>
    </body>
</html>
