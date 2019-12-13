<!doctype html>
<html lang="pt-br">
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="content-language" content="pt-br" />
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="robots" content="index, follow">

<title>Converter img em texto</title> 
<link href="style.css" rel="stylesheet" type="text/css">
<script>
function validateForm() {
    var valid = true;
    document.getElementById("output").remove();
    document.getElementById("validation-response").style.display = "none";
    document.getElementById("validation-response").value = "";

    if(document.form.txt_input.value == "") {
        document.getElementById("validation-response").style.display = "block";
        document.getElementById("validation-response").innerHTML = "Informe o texto";
        valid = false;
    }  
    
    return valid;
}
</script>
</head>
<body>
<div class="journal-txt">
                                <h4><a href="#" class="titulo">Convertendo TEXTO em IMAGEM com PHP</a></h4>
                                <div class="post-meta">
                                 
                                </div>


                           </div>
<div class="container" style="background-color:#00BFFF;text-align:center">

    <form name="form" id="form" method="post" action="index.php"
        enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class="form-row">

            <div>
                <label>Informe o texto:</label> <input type="text"
                    class="input-field" name="txt_input" maxlength="50">
            </div>
        </div>
        <div class="button-row">
            <input type="submit" id="submit" name="submit"
                value="Converter">
        </div>
    </form>
    <div id="validation-response"></div>
</div>
<div class="footer-address-container">

<a title="renatolucena.net  - 2019" href="//www.renatolucena.net ">renatolucena.net  - 2019</a>
      </div>
</body>
</html>
<?php
if (!empty($_POST['txt_input'])) {
    $input_text = $_POST['txt_input'];
    $width = (strlen($input_text)*9)+20;
    $height = 30;
    
    $textImage = imagecreate($width, $height);
    $color = imagecolorallocate($textImage, 0, 0, 0);
    imagecolortransparent($textImage, $color);
    imagestring($textImage, 5, 10, 5, $input_text, 0xFFFFFF);
    
    
    // create background image layer
    $background = imagecreatefromjpeg('abstract.jpg');
    
    // Merge background image and text image layers
    imagecopymerge($background, $textImage, 15, 15, 0, 0, $width, $height, 100);
    
    
    $output = imagecreatetruecolor($width, $height);
    imagecopy($output, $background, 0, 0, 20, 13, $width, $height);
    
    
    ob_start();
    imagepng($output);
    printf('<img id="output" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean()));
}
?>

