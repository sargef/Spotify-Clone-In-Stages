<?php

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$allowedExtensions = array(
    'wav', 'mp3'
);
$message = "file is too large";
$message2 = "Yeah";
$message3 = "Filetype not allowed";
$message4 = "File exists already, please rename";

if( $_FILES['file']['name'] != "" ) {
    $path=$_FILES['file']['name'];
    $pathto="sounds/".$path;

$extension = pathinfo($path, PATHINFO_EXTENSION);
$extension = strtolower($extension);


if(!in_array($extension, $allowedExtensions)){

    // header("Refresh:1; url=newMusic.php"); 
    echo "<script type='text/javascript'>alert('$message3');</script>";
    $_SESSION['message'] = 'Error!';
    exit();
}

$song_name = $_SERVER['DOCUMENT_ROOT'] . $_FILES['file']['name'];
if(file_exists($song_name)) {
    $_SESSION['message'] = 'Error!';
    exit();
}
if (file_exists($_FILES['file']['name'])) {
    header("Refresh:1; url=newMusic.php"); 
    echo "<script type='text/javascript'>alert('$message4');</script>";
    $_SESSION['message'] = 'Error!';
    exit();
}
if (file_exists($extension)) {
    header("Refresh:2; url=newMusic.php"); 
    
    echo "<script type='text/javascript'>alert('$message');</script>";
    exit();
}
 else {
    move_uploaded_file( $_FILES['file']['tmp_name'],$pathto) or die( "Could not copy file!");
    // header('Location: newMusic.php');
    }
}
else {
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    $_SESSION['message'] = 'Error!';
    echo 'That extension is not allowed!';
        // die("No file specified!");

}
?>


