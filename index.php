<?php

header("content-type:text/html; charset=iso-8859-1;");
require_once("csvparse.php");

$csv = new csv("Vareliste.csv");

$csv->toArray();

$csv->html_table();
?>