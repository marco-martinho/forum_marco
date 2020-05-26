<?php
/* json format
{
  "x":"inhalt",
  "y":100,
  "file":[ "file1.jpg", "file2.gif", "file3.txt" ]
}*/
//$arr = array("file"=>[ "file1.jpg", "file2.gif", "file3.txt"]);
$arr = array("file1.jpg", "file2.gif", "file3.txt");
echo json_encode($arr);
?>