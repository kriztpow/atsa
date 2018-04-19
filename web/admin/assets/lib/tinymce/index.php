<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Probando</title>
<meta name="keywords" content="">
<meta name="description" content="">
<script src="tinymce.min.js"></script>


<script language="javascript" type="text/javascript">
tinyMCE.init({
      selector: '#tinymce',
//toolbar: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify,  formatselect, fontsizeselect, cut, copy, paste, bullist, numlist, blockquote, undo, redo, code, removeformat, forecolor backcolor, media',//default
toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
menubar: false,
width: 1000,
height: 300,
plugins: [
  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
  'save table contextmenu directionality emoticons template paste textcolor colorpicker media'
],
media_live_embeds: true,
language: 'es',
  //language_url: '../probando/langs/es.js',
//statusbar: false,
   });

</script>
</head>
<body>

<h1>Probando</h1>
 <form method="post" name="tinymce" action="form.php">
      <textarea id="tinymce" name="texto"></textarea>
<input type="submit">
   </form>
<!------- scripts 
<script src="jquery.tinymce.min.js"></script>------>
<script src="jquery-3.1.1.min.js"></script>


</body>
</html>
