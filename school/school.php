<?php 

    include("./Math.php");

    $Math = new Math();

    $Calcultor = $Math->calculator();


    $Calcultor->reset();

    $result = $Calcultor->Create_Sentence("x! - y!")->bindVariable("x", 5, "y", 3)->Calculate()->getResult(10);


    echo $result;



    

?>