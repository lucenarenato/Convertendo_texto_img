# Convertendo TEXTO em IMAGEM com PHP

> A maioria das operações baseadas em imagem pode ser executada usando funções internas do PHP. As funções PHP baseadas em imagem estão na biblioteca GD e podemos usá-las para converter texto em uma imagem. Antes disso, devemos garantir que a biblioteca GD esteja ativada na configuração do php.ini. Você também pode executar a função PHP phpinfo () para verificar se o GD está ativado.

> Eu envio uma entrada de texto através de um formulário HTML para o código PHP. No PHP, invoco as funções da biblioteca GD para converter essa entrada de texto em uma imagem. Crio camadas de imagem para colocar o texto e o plano de fundo. Em seguida, mesclei as camadas e copiei a parte necessária para mostrar a imagem final de saída para o navegador. Se nenhum texto for inserido, ele será resolvido com a validação do JavaScript.

## Formulário HTML

```html
form name="form" id="form" method="post" action="index.php"
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

```

> Convertendo texto em uma imagem usando funções PHP GD
> No PHP, com o uso da função de biblioteca GD, podemos converter a entrada de texto em uma imagem. Eu criei uma camada de imagem transparente para colocar a entrada de texto nela. > > Em seguida, criei uma camada de imagem de fundo e a fundi com a camada de entrada de texto usando imagecopymerge (). Após a mesclagem, cortei a parte necessária da camada mesclada usando imagecopy () e produzi a imagem final para o navegador

```php
<?php
if (isset($_POST['submit'])) {
    
    $img = imagecreate(500, 100);
    
    $textbgcolor = imagecolorallocate($img, 173, 230, 181);
    $textcolor = imagecolorallocate($img, 0, 192, 255);
    
    if ($_POST['txt_input'] != '') {
        $txt = $_POST['txt_input'];
        imagestring($img, 5, 5, 5, $txt, $textcolor);
        ob_start();
        imagepng($img);
        printf('<img src="data:image/png;base64,%s"/ width="100">', base64_encode(ob_get_clean()));
    }
}
?>
```
- Renato Lucena - 2019
