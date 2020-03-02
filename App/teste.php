<?php

require_once('./Classe/Import.php');


$import = new Import();
$import->importarCSV("./resource/import.csv");

