<?php
     //carrega o composer
     require './vendor/autoload.php';

     //referencia o namespace
     use Dompdf\Dompdf;
 
     //instancia e usa a classe dompdf
     $dompdf = new Dompdf();
 
     $dompdf->loadHtml('hello world');
 
     $dompdf->setPaper('A4', 'landscape');
 
     $dompdf->render();
 
     $dompdf->stream();
?> 