<?php
$openId = $_GET["id"];
$path = "./" . $openId . ".txt";
$name = "KIND";
$avatar = "kind";
if (file_exists($path)) {
    $json = json_decode(file_get_contents($path));
    $name = $json->name;
    $avatar = $json->pic;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>
    <title><?php echo $name; ?> 是我10年前的网名</title>
    <style>
      body{
        margin:0 auto;
        text-align:center;
      }
      h2{
        display:block;
        width:640px;
        font-weight:400;
        font-size:48px;
        line-height:1.4;
        max-width:640px;
        text-align:left;
        margin:20px;
        border-bottom: 1px solid #e7e7eb;
      }
    #date{
      color:#8c8c8c;
      font-size:30px;
      float:left;
      font-style:normal;
      margin-right:8px;
      margin-left:20px;
      margin-bottom:10px;
    }
    #kind{
      color:#607fa6;
      font-size:30px;
      float:left;
      text-decoration: none;
      font-style:normal;
      margin-right:8px;
      margin-bottom:10px;
    }
      #qqwrap{ 
        width:100%;
        height:1286px;
        text-align:center;
        position:relative;
      }
      #qqbg{
        width:500px;
        height:auto;
        left:0px;
        margin-left:70px;
        margin-right:70px;
        position:absolute;
      }
      #qqavatar{
        width:120px;
        left:295px;
        top:275px;
        height:auto;
        position:absolute;
      }
      #qqname1{
        width:400px;
        text-align:left;
        overflow:hidden;
        white-space:nowrap;
        display:block;
        text-overflow:ellipsis;
        left:175px;
        top:80px;
        font-size:35px;
        position:absolute;
      }
      #qqname2{
        width:300px;
        text-align:center;
        overflow:hidden;
        white-space:nowrap;
        display:block;
        text-overflow:ellipsis;
        left:205px;
        top:400px;
        color:#ff3333;
        font-size:35px;
        position:absolute;
      }
    </style>
  </head>
  <body>
  <h2><?php echo $name ?> 是我10年前的网名</h2>
    <p><em id="date">2015-03-10</em><a id="kind">KIND</a></p>
    <p>
      <img id="head" src="./img/qqtop.jpg"/>
    </p>
    <div id="qqwrap">
    <img id="qqbg" src="./img/qqbg.jpg" />
<?php
echo "<img id=\"qqavatar\" src=\"./img/qqavatar/" . $avatar . ".png\" />";
echo "<label id=\"qqname1\">" . $name . "</label>";
echo "<label id=\"qqname2\">" . $name . "</label>";
?>
    </div>
    <p>
      <img id="foot" src="./img/qqbottom.jpg"/>
    </p>
  </body>
</html>