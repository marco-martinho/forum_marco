<?php
/* json format
{
  "x":"inhalt",
  "y":100,
  "file":[ "file1.jpg", "file2.gif", "file3.txt" ]
}*/
//$arr = array("file"=>[ "file1.jpg", "file2.gif", "file3.txt"]);
$files = scandir("../upload");
//var_dump($files);
$bad = ['.','..','z.B config.php'];
$files = array_diff($files,$bad);
//$arr = array("file1.jpg", "file2.gif", "file3.txt");
echo json_encode($files);
?>