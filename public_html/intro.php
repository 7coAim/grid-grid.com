<?php
//HTML描画開始
function introHTML(){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>GridGrid - あなただけのスタートページを作る - grid-grid.com</title>
    <meta charset="utf-8">
    <meta name = "application-name" content ="GridGrid" />
    <meta name = "author" content ="GridGrid" />
    <meta name = "description" content = "GridGridはアイコンの位置/画像/サイズを自由にカスタマイズできるブックマークWEBアプリです" />
    <meta name = "keywords" content = "GridGrid,grid-grid,grid-grid.com,Grid,ブックマーク,カスタマイズ,レイアウト,リンク,アイコン,タイル,WEBサービス,WEBアプリ,Android,iPhone,スマホ,アプリ" />
    <meta http-equiv="Content-Style-Type" content="text/css">
    <link href='http://fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="dist/jquery.gridster.css">
    <link rel="stylesheet" type="text/css" href="libs/jquery/jquery-ui.css">
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/furatto.css" />
    <script type="text/javascript" src="libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="libs/jquery/jquery-ui.js"></script>
    <script type="text/javascript" src="dist/jquery.gridster.js"></script>
    <script type="text/javascript" src="src/jquery.gridster.js"></script>
    <script type="text/javascript" src="gridstr.js"></script>
    <script type="text/javascript">


        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.___gcfg = {lang: 'ja'};
        
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
        
        (function(d,s,id){
          var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
          if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
          fjs.parentNode.insertBefore(js,fjs);}
        })(document, 'script', 'twitter-wjs');

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-42391062-1', 'grid-grid.com');
        ga('send', 'pageview');

        var grid_size = 125;

    </script>
</head>
<body>
<div id='name' />
<div id='demo' />

<!-- ▼▼▼ header -->
<div class="container">
  <div class="furatto-block">
    <div class="furatto-jumbo-header">
      <div class="furatto-jumbo-container">
        <h1 class="jumbo-header">GridGrid</h1>
        <p class="motto">
          GridGridで、あなただけのスタートページを作ることができます
        </p>
        <a href="./login_tw.php">
          <img src="./img/login_tw.jpg" width="305" height="100" hspace="20" vspace="20" alt="Twitterで登録・ログイン">
        </a>
        <a href="#" onClick="window.alert('現在、Facebookログイン機能は停止しています m(_ _)m'); return false;" class="login_fb_link">
          <img src="./img/login_fb.jpg" width="305" height="100" hspace="20" vspace="20" alt="Facebookで登録・ログイン">
        </a>
        <div>
            <img src="./img/top1.png" WIDTH=400 HEIGHT=300>
            <img src="./img/top2.png" WIDTH=400 HEIGHT=300>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ▼▼▼ try -->
<h2 class="text-center">操作を体験</h2>
<h4 class="text-center">タイルをドラッグ&amp;ドロップでレイアウト</h4>
<div id="try">
  <div id="container" class="container">
    <div class="layouts_grid" id="layouts_grid">
    <ul>

    <li class="layout_block" data-row="1" data-col="1" data-sizex="1" data-sizey="2" style="background-color: #F6CA06;">
      <div class="box"><div class="menu">
        <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
      </div></div>
    </li>

    <li class="layout_block" data-row="3" data-col="1" data-sizex="2" data-sizey="1" style="background-color: #D8E212;">
        <div class="box"><div class="menu">
        <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div></div>
    </li>

    <li class="layout_block" data-row="1" data-col="2" data-sizex="2" data-sizey="1" style="background-color: #23AC0E;">
        <div class="box"><div class="menu">
        <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div></div>
    </li>

    <li class="layout_block" data-row="2" data-col="2" data-sizex="1" data-sizey="1" style="background-color: #DA8025;">
      <img src="./img/dragme.png" width=100% height=100%>
      <div class="box">
        <div class="menu">
          <div class="deleteme">
            <a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a>
          </div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="2" data-col="3" data-sizex="2" data-sizey="2" style="background-color: #007FB1;">
        <div class="box">
          <div class="menu">
            <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="1" data-col="4" data-sizex="2" data-sizey="1" style="background-color: #3261AB;">
        <div class="box">
          <div class="menu">
            <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="2" data-col="5" data-sizex="2" data-sizey="1" style="background-color: #009F8C;">
       <div class="box">
         <div class="menu">
           <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="3" data-col="5" data-sizex="1" data-sizey="1" style="background-color: #A52175;">
       <div class="box">
         <div class="menu">
           <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="1" data-col="6" data-sizex="1" data-sizey="1" style="background-color: #BF1E56;">
      <div class="box">
        <div class="menu">
          <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    <li class="layout_block" data-row="3" data-col="6" data-sizex="1" data-sizey="1" style="background-color: #EDAD0B;">
      <div class="box">
        <div class="menu">
          <div class="deleteme"><a  href="JavaScript:void(0);"><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div>
      </div>
    </li>

    </ul>
    </div>
  </div>
</div>
<br>

<!-- ▼▼▼ how to use -->
<div class="main-container">
  <div class="row-fluid">
    <div class="furatto-steps">
      <div class="span12">
      <h2>使い方は簡単</h2>
      <br><br>
        <div class="span6">
          <img src="./img/demo_1.jpg" width="400" height="198" hspace="2" vspace="20" alt="demo_1">
          <h2 class="step-header">自由なレイアウト</h2>
          <p class="step-desc">GridGridでは、自由自在なリンクの配置ができます。上のタイルで操作を体験できます。</p>
        </div>
        <div class="span6">
          <img src="./img/demo_2.jpg" width="400" height="198" hspace="2" vspace="20" alt="demo_2">
          <h2 class="step-header">好みの画像をリンクや背景に</h2>
          <p class="step-desc">"タイルの追加"や"オプション"から、リンクや背景を設定できます。</p>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="main-container">
  <div class="row-fluid">
    <div class="furatto-steps">
      <br><br><br><br><br>
      <h2>登録・ログインはSNSアカウントと連携するだけ</h2>
        <a href="./login_tw.php">
          <img src="./img/login_tw.jpg" width="305" height="100" hspace="20" vspace="20" alt="Twitterで登録・ログイン">
        </a>
        <a href="#" onClick="window.alert('現在、Facebookログイン機能は停止しています m(_ _)m'); return false;" class="login_fb_link">
          <img src="./img/login_fb.jpg" width="305" height="100" hspace="20" vspace="20" alt="Facebookで登録・ログイン">
        </a>
    </div>
  </div>
</div>

<!-- ▼▼▼ social -->
<div class="footer" style="background:#F5F5F5; margin: 50px 0 -50px;">
  <div class="footer-wrapper">
    <div class="container">
      <div class="row-fluid">
        <ul class="hrz-nav text-center" >
          <li><div class="fb-like" data-href="http://grid-grid.com/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div></li>
          <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://grid-grid.com" data-text="あなただけのスタートページを作る『GridGrid』" data-via="" data-lang="ja">tweet</a></li>
          <li><a href="http://b.hatena.ne.jp/entry/http://grid-grid.com/" class="hatena-bookmark-button" data-hatena-bookmark-title="GridGrid" data-hatena-bookmark-layout="simple-balloon" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></li>
          <li><div class="g-plusone" data-size="medium"></div></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ▼▼▼ footer -->
<div class="footer">
  <div class="footer-wrapper">
    <div class="container">
      <div class="row-fluid">
        <ul class="hrz-nav text-center">
          &copy; 2013-2018 <a href="./index.php">GridGrid</a>
          <!-- <li><a href="#">プライバシーポリシー</a></li> -->
          <li><a href="https://goo.gl/forms/FCdNqhF1OzD6FvFh2" target='_blank'>フィードバックを寄せる</a></li>
          <li style="color: #EEE;padding: 0 0 0 30px;">Support Browser ：</li>
          <li style="color: #EEE;">Google Chrome</li>
          <li style="color: #EEE">Firefox</li>
          <li style="color: #EEE">Opera</li>
          <li style="color: #EEE">Internet Explorer</li>
        </ul>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php
}
//上記 閉じダグは消さないで下さい
//php function 終了
?>