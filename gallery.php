<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<?php
$time=time();
if (session_id()=='') session_start();

$db=mysqli_connect("localhost", "root", "", "db") or die();
$res=mysqli_query($db,"set names utf8");

$mess_url=mysqli_real_escape_string($db,basename($_SERVER['SCRIPT_FILENAME']));

//получаем id текущей темы
$res=mysqli_query($db,"SELECT id FROM таблица WHERE file_name='".$mess_url."'");

$theme_id=$res["id"];

if (isset($_POST["contr_cod"])){    //отправлен комментарий
 $mess_login=htmlspecialchars($_POST["mess_login"]);
 $user_text=htmlspecialchars($_POST["user_text"]);
 if (md5($_POST["contr_cod"])==$_POST["prov_summa"]){    //код правильный
  if ($mess_login!='' and $user_text!=''){
   if (is_numeric($_POST["parent_id"]) and is_numeric($_POST["f_parent"]))
    $res=mysqli_query($db,"insert into comment
    (parent_id, first_parent, date, theme_id, login, message)
    values ('".$_POST["parent_id"]."','".$_POST["f_parent"]."',
    '".$time."','".$theme_id."','".$mess_login."','".$user_text."')");
   else $res=mysqli_query($db,"insert into comment (date, theme_id, login, message)
   values ('".$time."','".$theme_id."','".$mess_login."','".$user_text."')");
    $_SESSION["send"]="Комментарий принят!";
    header("Location: $mess_url#last"); exit;
  }
  else {
   $_SESSION["send"]="Не все поля заполнены!";
   header("Location: $mess_url#last"); exit;
  }
 }
 else {
  $_SESSION["send"]="Неверный проверочный код!";
  header("Location: $mess_url#last"); exit;
 }
}

if (isset($_SESSION["send"]) and $_SESSION["send"]!="") {    //вывод сообщения
    echo '<script type="text/javascript">alert("'.$_SESSION["send"].'");</script>';
    $_SESSION["send"]="";
}
?>

<?php 
if (get_magic_quotes_gpc()) {
        function stripslashes_deep($value)
        {
            $value = is_array($value) ?
                        array_map('stripslashes_deep', $value) :
                        stripslashes($value);

            return $value;
        }

        $_POST = array_map('stripslashes_deep', $_POST);
        $_GET = array_map('stripslashes_deep', $_GET);
        $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
        $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
    }

   function my_strip_tags($str) {
                $strs=explode('<',$str);
                $res=$strs[0];
                for($i=1;$i<count($strs);$i++)
                {
                    if(!strpos($strs[$i],'>'))
                        $res = $res.'&lt;'.$strs[$i];
                    else
                        $res = $res.'<'.$strs[$i];
                }
             return strip_tags($res);   
    }
    function add_comment($comment,$type,$update_id,$user_id){
            $query="INSERT INTO comment_updates (updateid,userid,comment) VALUES(?,?,?)";
                if($stmt=$this->conn->prepare($query)) {
                $stmt->bind_param('sss',$update_id,$user_id,$comment);
                $stmt->execute();
                    if($this->conn->affected_rows==1){
                    $stmt->close();
                    return true;
                    }
            }
        }
 ?>
<html lang="en">
<head>
<title>DreamDraw an Education Category Bootstrap Responsive Web Template | Gallery :: w3layouts</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="DreamDraw Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- // custom-theme -->
<!--css links-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /><!--bootstrap-->
<link href="css/font-awesome.css" rel="stylesheet"><!--font-awesome-->
<link href="css/lightcase.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!--stylesheet-->
<!--//css links-->
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700" rel="stylesheet">
<!--//fonts-->
</head>
<style>
/*comment*/

    .add_comment {
        display: table;
        width: 100%;
        float: left;
        margin-left: 3px;
        margin-bottom: -55px;
        margin-top: -55px;
        border: 1px solid #000;
        background-color: white
    }
    .close_hint, .open_hint {
        float: right;
        border: 1px solid #77A;
        background: #6e6;
        width: 100px;
        text-align: center;
        cursor: pointer;
    }
    .close_hint { margin: 5px; color: #F00; }
    .comm_body { padding: 0 5px; background-color:#EEE; text-align:left; }
    .comm_head { padding: 3px; border: 1px solid #77A; background-color: #DFD; }
    .comm_minus { background: url('images/design.png') no-repeat; }
    .comm_plus { background: url('images/design.png') no-repeat; }
    .comm_minus, .comm_plus {
        float: right;
        width: 19px;
        height: 18px;
        cursor: pointer;
    }
    .comm_text { display:none; }
    .sp_link { color: #F33; cursor: pointer; }
    .strelka {
        background: url(images/design.png) no-repeat;
        border-left: 2px solid #000;
    }
    .strelka_2 { background: url(images/design.png) no-repeat; }
    #hint { position: absolute; display: none; z-index: 100; }
/*//comment*/
	/* pop up for sign in and sign up form */

#small-dialog1 h3{
    color: #000;
    font-size: 30px;
    margin-bottom: 30px;
    text-align: center;
}
#small-dialog1 input[type="text"], #small-dialog1 input[type="password"], #small-dialog1 input[type="email"], #small-dialog1 input[type="password"] {
    padding: 12px;
    font-size: 14px;
    border: 2px solid #f1b458;
    background: transparent;
    outline: none;
    width: 100%;
    margin-bottom: 20px;
}
div#small-dialog1,div#small-dialog2 {
    padding: 50px;
}
form ul {
    float: left;
    list-style-type: none;
}
form a {
    color: #000;
    float: right;
    font-size: 13px;
}
#small-dialog1 input[type="submit"], #small-dialog1 input[type="submit"] {
    background: #f1b458;
    border: none;
    padding: 10px 15px;
    color: #fff;
    font-size: 14px;
    outline: none;
    margin-top: 30px;
    width: 100%;
}
.modal-content{
    border-radius: 0px;
}
.modal-dialog {
    width: 500px;
    margin: 30px auto;
}
ul li input[type="checkbox"]+label {
    position: relative;
    padding-left: 25px;
    border: #f1b458;
    color: #000;
    display: inline-block;
    font-size: 13px;
}
ul li input[type="checkbox"]+label span:first-child {
    width: 17px;
    height: 15px;
    display: inline-block;
    border: 1px solid #000;
    position: absolute;
    top: 1px;
    left: 4px;
    bottom: 4px;
}
input[type="radio"], input[type="checkbox"] {
    display: none;
}
ul li input[type="checkbox"]:checked+label span:first-child:before {
    content: "";
    background: url(../images/tick.png)no-repeat;
    position: absolute;
    left: 2px;
    top: 2px;
    font-size: 10px;
    width: 10px;
    height: 10px;
}
#small-dialog2 h3 {
    color: #000;
    font-size: 30px;
    margin-bottom: 30px;
    text-align: center;
}
#small-dialog input[type="text"], #small-dialog input[type="password"], #small-dialog2 input[type="text"], #small-dialog2 input[type="email"], #small-dialog2 input[type="password"] {
    padding: 12px;
    font-size: 14px;
    border: 2px solid #f1b458;
    background: transparent;
    outline: none;
    width: 100%;
    margin-bottom: 20px;
}
#small-dialog input[type="submit"], #small-dialog2 input[type="submit"] {
    background: #f1b458;
    border: none;
    padding: 10px 15px;
    color: #fff;
    font-size: 14px;
    outline: none;
    margin-top: 30px;
    width: 100%;
}
/* //pop up for sign in and sign up form */

</style>

<body>
<!-- Header -->
<div id="home" class="banner1 w3l">
		<div class="header-nav">
			<nav class="navbar navbar-default">
			<div class="header-top">
					<div class="navbar-header logo">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h1>
									<a class="navbar-brand" href="index.html"><i class="fa fa-paint-brush" aria-hidden="true"></i>DreamDraw</a>
								</h1>
					</div>
					<!-- navbar-header -->
					<div class="contact-bnr-w3-agile">
								<ul>
									<li>
									<a href="#" data-toggle="modal" data-target="#myModal">
									<i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
								</ul>
							</div>
							</div>
					<div class="collapse navbar-collapse cl-effect-13" id="bs-example-navbar-collapse-1">

						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">Home</a></li>
							<li><a href="about.html">About</a></li>
							
							<!--<li><a href="gallery.html">Gallery</a></li>-->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Level<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="gallery.html">Beginner</a></li>
									<li><a href="gallery.html">Intermediate</a></li>
									<li><a href="gallery.html">Advanced</a></li>
								</ul>
							</li>
							<li><a href="Gallery1.html" class="active">Styles</a></li>
							
							<li><a href="contact.php">Contact</a></li>
						</ul>

					</div>
					<div class="clearfix"> </div>	
				</nav>
							<div class="clearfix"> </div>
		</div>
</div>	
<!-- //Header -->
<!-- gallery inner -->
<div class="inner-padding">
    <div class="container">
    <h3 class="heading-agileinfo">For Beginners<span>Lorem ipsum dolor sit amet elit.</span></h3>
        <div class="w3ls_portfolio_grids">
                <div class="col-md-4 agileinfo_portfolio_grid">
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-1.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-1.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-2.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-2.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-3.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-3.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 agileinfo_portfolio_grid">
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-4.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-4.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-5.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-5.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-5.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-5.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 agileinfo_portfolio_grid">
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-4.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-4.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-3.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-3.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid1">
                        <a href="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-2.jpg" class="showcase" data-rel="lightcase:myCollection:slideshow" title="DreamDraw">
                            <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">  
                                <div class="w3layouts_port_head">
                                    <h3>DreamDraw</h3>
                                </div>
                                <img src="images/kak_narisovat_portret_dzhareda_leto_prostym_karandashom-2.jpg" alt=" " class="img-responsive">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="typography inner-padding">
                <div class="container">
<div class="grid_3 grid_5 wow fadeInUp animated" data-wow-delay=".5s">
                        <h4 class="hdg">Similar pictures</h4>
                        <div class="col-md-6">
                            
                            <table class="table table-bordered">
                                
                                <tbody>
                                    
                                    <tr>
                                        <td><a href="">Rihanna<a></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><a href="">Jennifer Lopes<a></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><a href="">Rick Martin</a></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><a href="">Jennifer Aniston</a></td>
                                        
                                    </tr>
                                    <tr>
                                        <th><a href="">David Baekham</a></th>
                                        
                                        
                                    </tr>
                                </tbody>
                            </table>                    
                        </div>
                        <div class="col-md-6">
                           
                            <div class="list-group list-group-alternate"> 
                                <a href="#" class="list-group-item"><span class="badge">201</span> <i class="ti ti-email"></i> Inbox </a> 
                                <a href="#" class="list-group-item"><span class="badge badge-primary">5021</span> <i class="ti ti-eye"></i> Profile visits </a> 
                                <a href="#" class="list-group-item"><span class="badge">14</span> <i class="ti ti-headphone-alt"></i> Call </a> 
                                <a href="#" class="list-group-item"><span class="badge">20</span> <i class="ti ti-comments"></i> Messages </a> 
                                <a href="#" class="list-group-item"><span class="badge badge-warning">14</span> <i class="ti ti-bookmark"></i> Bookmarks </a> 
                                <a href="#" class="list-group-item"><span class="badge badge-danger">30</span> <i class="ti ti-bell"></i> Notifications </a> 
                            </div>
                        </div>
                       <div class="clearfix"> </div>
                    </div>  
                    </div>
                    </div>
	<!-- //gallery inner -->
<!-- footer -->
<div class="inner-padding">
<div class="container">
<?php
$cod=rand(1,10); $cod2=rand(1,10);
echo '<div id="last" align="center">';

echo '<form method="POST" action="'.$mess_url.'#last" class="add_comment"';
echo 'name="add_comment" id="hint"><div class="close_hint">Закрыть</div>';
echo '<div style="margin-left:20px; margin-top:10px; float:left;">';
echo 'Имя: <input type="text" name="mess_login" maxlength="20" value=""></div>';
echo '<div style="margin-left:20px; margin-right:450px; margin-top:20px; float:left;">';
echo 'Добавить комментарий: <textarea cols="78" rows="5" name="user_text"></textarea></div>';
echo '<div style="margin-left:-5px; margin-top:20px; margin-right:450px; float:left;"> Проверочный код: '
.$cod.' + '.$cod2.' = ';
echo '<input type="hidden" name="prov_summa" value="'.md5($cod+$cod2).'">';
echo '<input type="hidden" name="parent_id" value="0">';
echo '<input type="hidden" name="f_parent" value="0">';
echo '<input type="text" name="contr_cod" maxlength="10" size="5">';
echo '<div style="margin-left:25px; margin-top:20px; margin-bottom:15px; float:left;"> ';
echo '<input type="submit" value="Отправить"></div></div>';
echo '</form>';

echo '<form method="POST" action="'.$mess_url.'#last" class="add_comment">';
echo '<div style="margin-left:20px; margin-top:30px; float:left;">';
echo 'Имя: <input type="text" name="mess_login" maxlength="20" value=""></div>';
echo '<div style="margin-left:20px; margin-right:450px; margin-top:20px; float:left;">';
echo 'Добавить комментарий: <textarea cols="88" rows="5" name="user_text"></textarea></div>';
echo '<div style="margin-left:-150px; margin-top:20px; margin-bottom:20px; margin-right:50px; float:left;"> Проверочный код: '.$cod.' + '.$cod2.' = ';
echo '<input type="hidden" name="prov_summa" value="'.md5($cod+$cod2).'<br>">';

echo '<input type="text" name="contr_cod" maxlength="10" size="5">';
echo '<div style="margin-left:170px; margin-top:50px; margin-bottom:15px; float:left;"> ';
echo '<input type="submit" value="Отправить"></div></div>';
echo '</form></div>';
?></div></div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="inner-padding">
<div class="container">
<?php
function parents($up=0, $left=0) {    //Строим иерархическое дерево комментариев
global $tag,$mess_url;

for ($i=0; $i<=count($tag[$up])-1; $i++) {
 //Можно выделять цветом указанные логины
 if ($tag[$up][$i][2]=='Admin') $tag[$up][$i][2]='<font color="#C00">Admin</font>';
 if ($tag[$up][$i][6]==0) $tag[$up][$i][6]=$tag[$up][$i][0];
 //Высчитываем рейтинг комментария
 $sum=$tag[$up][$i][4]-$tag[$up][$i][5];

 if ($up==0) echo '<div style="padding:5px 0 0 0;">';
 else {
    if (count($tag[$up])-1!=$i)
        echo '<div class="strelka" style="padding:5px 0 0 '.($left-2).'px;">';
    else echo '<div class="strelka_2" style="padding:5px 0 0 '.$left.'px;">';
 }
 echo '<div class="comm_head" id="m'.$tag[$up][$i][0].'">';
 echo '<div style="float:left;"><b>'.$tag[$up][$i][2].'</b></div>';
 echo '<div class="comm_minus"></div>';
 echo '<div style="float:right; width:30px;" id="rating_comm'.$tag[$up][$i][0].'">';
 echo '<b>'.$sum.'</b></div><div class="comm_plus"></div>';
 echo '<a style="float:right; width:70px;" href="'.$mess_url.'#m';
 echo $tag[$up][$i][0].'"># '.$tag[$up][$i][0].'</a>';
 echo '<div style="float:right; width:170px;">';
 echo '('.date("H:i d.m.Y", $tag[$up][$i][3]).' г.)</div>';
 echo '<div style="clear:both;"></div></div>';
 echo '<div class="comm_body">';
 if ($sum<0) echo '<u class="sp_link">Показать/скрыть</u><div class="comm_text">';
 else echo '<div style="word-wrap:break-word;">';
 echo str_replace("<br />","<br>",nl2br($tag[$up][$i][1])).'</div>';
 echo '<div class="open_hint" onClick="comm_on('.$tag[$up][$i][0].',
     '.$tag[$up][$i][6].')">Ответить</div><div style="clear:both;"></div></div>';

 if (isset($tag[ $tag[$up][$i][0] ])) parents($tag[$up][$i][0],20);
 echo '</div>';
}
}

$res=mysqli_query($db,"SELECT * FROM comment
    WHERE theme_id='".$theme_id."' ORDER BY id");
$number=mysqli_num_rows($res);

if ($number>0) {
 echo '<div style="border:1px solid #000000;padding:5px;text-align:center;">';
 echo '<b>Последние комментарии:</b><br>';
 while ($com=mysqli_fetch_assoc($res))
    $tag[(int)$com["parent_id"]][] = array((int)$com["id"], $com["message"],
    $com["login"], $com["date"], $com["plus"], $com["minus"], $com["first_parent"]);
 echo parents().'</div><br>';
}
?></div></div>
<!-- footer -->
<div class="clearfix"></div>
    <div class="footer w3layouts">
        <div class="container">
            <div class="footer-agileinfo">
                <div class="col-md-5 col-sm-6 footer-grid">
                    <h3>Useful Info</h3>
                    <p>Lorem Ipsum was popularised In sit amet sapien eros Integer dolore magna aliqua Temporibus autem quibusdam et aut officiis debitis aut rerum necess itatibus saepe.</p> 
                </div> 
                <div class="col-md-3 col-sm-6 footer-grid footer-tags">
                    <h3>Media</h3>
                    <ul>
                        <li><a href="#"><i class="fa fa-google-plus"></i>Google-plus</a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i>Dribbble</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 footer-grid footer-review">
                    
                    <h3>Latest Tweets</h3>
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accus.
                            <br><a href="#">http//example.com</a>
                            <br><span>About 15 minutes ago<span>
                        </span></span></li>
                    </ul>

                </div>
                
                <div class="clearfix"> </div>
            </div> 
        </div>
    </div>
    <div class="copy-right wthree"> 
        <div class="container">
            <p>All rights reserved | Design by <a href="http://w3layouts.com"> Kurma.</a></p>
        </div>
    </div>  
    
<!--//footer -->
<!-- js -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!--//js -->
<!-- light-case -->
	<script src="js/lightcase.js"></script>
	<script src="js/jquery.events.touch.js"></script>
	<script>
		$('.showcase').lightcase();
	</script>
<!-- //light-case -->
<script src="js/SmoothScroll.min.js"></script>
<!--Scrolling-top -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!--//Scrolling-top -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<script type="text/javascript">
//Добавление в форму отправки комментария значений id родительских комментариев
function comm_on(p_id,first_p){
    document.add_comment.parent_id.value=p_id;
    document.add_comment.f_parent.value=first_p;
}

$(document).ready(function(){
//Показать скрытое под спойлером сообщение
$(".sp_link").click(function(){
    $(this).parent().children(".comm_text").toggle("normal");
});

//Показать форму ответа на имеющийся комментарий
$(".open_hint").click(function(){
    $("#hint").animate({
        top: $(this).offset().top + 25, left: $(document).width()/2 -
        $("#hint").width()/2
    }, 400).fadeIn(800);
});

//Скрыть форму ответа на имеющийся комментарий
$(".close_hint").click(function(){ $("#hint").fadeOut(1200); });

//Получение id оцененного комментария
$(".comm_plus,.comm_minus").click(function(){
    id_comm=$(this).parents(".comm_head").attr("id").substr(1);
});

//Отправление оценки комментария в файл rating_comm.php
$(".comm_plus").click(function(){
    jQuery.post("rating_comm.php",{comm_id:id_comm,ocenka:1},rating_comm);
});
$(".comm_minus").click(function(){
    jQuery.post("rating_comm.php",{comm_id:id_comm,ocenka:0},rating_comm);
});

//Возврат рейтинга комментария и его обновление
function rating_comm(data){
    $("#rating_comm"+id_comm).fadeOut(800,function(){
        $(this).html(data).fadeIn(800);
    });
}
});
</body>
</html>