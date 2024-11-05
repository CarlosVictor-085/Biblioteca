<?php
ob_start(); // Inicia o buffer de saída
header("Location: https://bibliotecavictin.free.nf/public/");
exit();
ob_end_flush(); // Libera o buffer de saída
?>
