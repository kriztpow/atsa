<?php
  ob_start();
  $datos_recebido = iconv('utf-8','iso-8859-1', $_POST['datos_a_enviar']);

?>
<page backtop="5mm" backbottom="5mm" backleft="10mm" backright="10mm">
 <?php echo $datos_recebido; ?>
</page>



<?php

  $content = ob_get_clean();
  require_once(dirname(__FILE__).'/vendor/autoload.php');

  use Spipu\Html2Pdf\Html2Pdf;
  use Spipu\Html2Pdf\Exception\Html2PdfException;
  use Spipu\Html2Pdf\Exception\ExceptionFormatter;

  try
  {
      $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output('PDF-CF.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }