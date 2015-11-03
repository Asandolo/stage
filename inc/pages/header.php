<?php 
session_start();
include("db.php"); 

if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
	header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>STAGE</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="inc/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="inc/css/font-awesome.css">
	<script data-cfasync="false" type="text/javascript" src="inc/js/jquery.js"></script>
	<script data-cfasync="false" type="text/javascript" src="inc/js/bootstrap.js"></script>
	<script data-cfasync="false" type="text/javascript" src="inc/js/tinymce/tinymce.min.js"></script>
	<script data-cfasync="false" type="text/javascript">
tinymce.init({
    selector: "textarea#tinymce",
    theme: "modern",
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>
</head>
<body>
<div class="container">
<a href="logout.php">deco</a>
<hr />