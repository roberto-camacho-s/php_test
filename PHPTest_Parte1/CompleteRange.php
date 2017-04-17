<!DOCTYPE html>
<?php 
    class CompleteRange {
        public function build($arreglo) {
            if (!$this->validar_solo_numeros($arreglo)) {
                return "El arreglo solo debe contener números enteros positivos.";
            }
            sort($arreglo);
            $valor_minimo = min($arreglo);
            $valor_maximo = max($arreglo);
            $texto_arreglo = "";
            for ($i = $valor_minimo; $i <= $valor_maximo; $i++) {
                $texto_arreglo .= $i.", ";
            }
            return "[".rtrim($texto_arreglo,", ")."]";
        }
        
        private function validar_solo_numeros($arreglo) {
            $numeros_en_arreglo = array_filter($arreglo, array($this, 'es_numero'));
            return count($arreglo) === count($numeros_en_arreglo);
        }
        
        private function es_numero($val){
            return is_int($val) && $val >= 0;
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Problema 02</title>
    </head>
    <body>
        <?php
            error_reporting(E_ERROR | E_PARSE);
            $complete_range = new CompleteRange();
            echo $complete_range->build([1, 2, 4, 5])."<br />"; //[1, 2, 3, 4, 5]
            echo $complete_range->build([2, 4, 9])."<br />"; //[2, 3, 4, 5, 6, 7, 8, 9]
            echo $complete_range->build([55, 58, 60])."<br />"; //[55, 56, 57, 58, 59, 60]
            echo $complete_range->build([25.5, 29, 31])."<br />"; //El arreglo solo debe contener números enteros positivos.
            echo $complete_range->build([-1, 3, 7, 8])."<br />"; //El arreglo solo debe contener números enteros positivos.
            echo $complete_range->build([14, "x", 17, 18])."<br />"; //El arreglo solo debe contener números enteros positivos.
        ?>
    </body>
</html>
