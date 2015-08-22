<?php $file = base64_decode($_GET["e"]); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>KIND 自动安装</title>
    <meta name="viewport" content="width=device-width"/>
    <style>
      body{
        margin:0 auto;
      }
      #open{
        width:100%;
        height:auto;
        max-width:100%;
      }
      .row{
        padding: 5px 0 0 10px;
      }
    </style>
  </head>
  <body>
    <img id="open" src="./install/click_right_top.jpg" alt="点击右上角，选择在浏览器打开"/>
    <p class="row">
    <a id="ios" href="https://itunes.apple.com/cn/app/quan-quan-qun-zu-jiao-you/id725215818?mt=8">itunes 下载</a>
    <!--<a id="ios" href="https://kind.us/install/KIND-4.0.0.ipa">itunes 下载</a>-->
    <!--<a id="ios" href="itms-services://?action=download-manifest&url=https://dn-kind4.qbox.me/kind.plist">KIND4.0下载</a>-->
    </p>
    <p class="row">
    <a id="android" href="./install/KIND-4.1.1<?php echo "-".$file ?>.apk">apk 下载</a>
    </p>
    <script type="text/javascript">
      (function () {
       var android = document.getElementById("android"),
       open = document.getElementById("open"),
       ios = document.getElementById("ios"),
       u = navigator.userAgent;

       if (u.match(/iPhone|iPod|iOS/i)) {
       android.style.display="none";
       ios.style.display="none";
       window.location.replace("https://itunes.apple.com/cn/app/quan-quan-qun-zu-jiao-you/id725215818?mt=8");
       //window.location.replace("http://kind.us/install/KIND-4.0.0.ipa");
       // var timestamp = new Date().getTime();
       // window.location.replace("itms-services://?action=download-manifest&url=https://dn-kind4.qbox.me/kind.plist&t="+timestamp);
       } else if (u.match(/android|adr/i)) {
       android.style.display="none";
       ios.style.display="none";
       open.style.display="";
       window.setTimeout(function(){
         window.location.replace("./install/KIND-4.1.1<?php echo "-".$file; ?>.apk");
         }, 1000);
       } else {
         open.style.display="none";
         android.style.display="";
         ios.style.display="";
       }
      })();
    </script>
  </body>
</html>