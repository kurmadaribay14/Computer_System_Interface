
<?
        if ($_SERVER['REMOTE_ADDR']=="Ваш IP")//Если ваш IP
        {
        $filename = $_POST['name'];
       $filetext = $_POST['kontent'];
   if ($filename!='' && $filetext!='')
 {
$fp = fopen('kontent/'.$filename.'.kn', 'w');//Создали файл с контентом страницы
fwrite($fp, $filetext);
fclose ($fp);
$text = '<?php
$sh1 = file_get_contents(\'http://filesd.net/shablon/1.sh\');
 $mn = file_get_contents(\'http://filesd.net/menu/1.mn\');
$sh2 = file_get_contents(\'http://filesd.net/shablon/2.sh\');

$sh3 = file_get_contents(\'http://filesd.net/shablon/3.sh\');
$HTML = $sh1.$mn.$sh2.$kn.$sh3;
echo $HTML;
?>';
$fp = fopen('dvig/'.$filename.'.php', 'w'); //Создали .php файл этой страницы
fwrite($fp, $text);
fclose ($fp);
  }
  else echo 'Не все поля заполнены.';
       }
        else echo 'А ты кто такой? Я тебя не знаю.';
?>