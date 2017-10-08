<?php
// We'll be outputting a PDF
header('Content-type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="'.$_REQUEST['file'].'"');

// The PDF source is in original.pdf
readfile($_REQUEST['file']);
?>
