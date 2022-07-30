<?php
/* Example code to upload and print xlsx */

$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["student_file"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  if($FileType == "xlsx") {
    if (move_uploaded_file($_FILES["student_file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename( $_FILES["student_file"]["name"]))."has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "Its not an excel file.";
    $uploadOk = 0;
  }
}

use Shuchkin\SimpleXLSX;

require_once __DIR__.'/lib/SimpleXLSX.php';

echo '<h1>Details of books.xslx</h1><pre>';
if ($xlsx = SimpleXLSX::parse("uploads/".$_FILES["student_file"]["name"])) {
    print_r($xlsx->rows());
} else {
    echo SimpleXLSX::parseError();
}
echo '<pre>';
?>