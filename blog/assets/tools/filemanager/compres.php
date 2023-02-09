<?php
require_once("lib/Tinify/Exception.php");
require_once("lib/Tinify/ResultMeta.php");
require_once("lib/Tinify/Result.php");
require_once("lib/Tinify/Source.php");
require_once("lib/Tinify/Client.php");
require_once("lib/Tinify.php");

\Tinify\setKey("Lvhylw6wgjXKwYqEgewcMEv78rDKgykb");

 $src_file_name='balkat-instagram.png';
 
 echo 'https://localhost/cmsnew/assets/file_upload/admin/'.$src_file_name;
  $source = \Tinify\fromFile('https://localhost/cmsnew/assets/file_upload/admin/'.$src_file_name);
  $source->toFile('https://localhost/cmsnew/assets/file_upload/admin/'.$src_file_name);
echo "All images are compressed.";
?>