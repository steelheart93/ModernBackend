<?php
$respuesta = "https://www.bing.com/HPImageArchive.aspx?format=js&n=1&idx=" . $_GET["idx"];
echo file_get_contents($respuesta);
