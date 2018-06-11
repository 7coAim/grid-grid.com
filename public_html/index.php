<?php
session_name('GridStar');
session_start();
require_once 'config.php';

//セッション監視
$no_UserID = '12345';
$_SESSION['no_UserID'] = $no_UserID;

if (empty($_SESSION['UserID'])) {
    $msg = 'ログイン状態 初回アクセス デモモードON';
    $_SESSION['UserID'] = $no_UserID;
} elseif ($_SESSION['UserID'] == $no_UserID) {
    $msg = 'ログイン状態 デモモードON';
} else {
    if (!empty($_SESSION['me'])) {
        $msg = 'ログイン状態 TW';
    } elseif (!empty($_SESSION['user'])) {
        $msg = 'ログイン状態 FB';
    } else {
        $msg = 'ログイン状態 Origin';
    }
}

//index.php 内容振り分け
if ($_SESSION['UserID'] == $no_UserID) {
    $demo = 0;
    //intoのHTMLインポート関数実行
    require_once 'intro.php';
    introHTML();
    //include(dirname(__FILE__).'/intro.php');
    exit;
} else {
    $demo = 1;
    //セッション管理
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), $_COOKIE[session_name()], time() + 604800, SITE_URL_DIR);
    }
    //ログインユーザー
}

//0.2.9 index.phpからの結合 開始
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
} catch (PDOException $e) {
    die($e->getMessage());
}
$data = '';
$a = $_SESSION['UserID'];
//テーブル設定 config.phpから読み込み
$table = DB_TABLE;
//DBから位置情報読み出し

    $sql = 'SELECT data FROM '.$table." WHERE name='".$_SESSION['UserID']."'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data = $row['data'];
    }

    $array = explode('}', $data);

    $i = 1;
    $j = 1;

    foreach ($array as $value) {
        //echo $value."<br>";
        $j = 0;
        $array2 = explode(',', $value);
        foreach ($array2 as $value2) {
            $kari = mb_ereg_replace('[^0-9]', '', $value2);
            // echo $kari."<br>";
            $d[$i][$j] = $kari;
            //echo "$i=".$i."$j=".$j."<br>";
            $j = $j + 1;
        }

        $i = $i + 1;
    }

    if (count($d) > 1) {
        for ($i = 4;$i > 0;--$i) {
            $aaa = $i - 1;
            $k[$i] = $d[1][$i - 1];
        }
        for ($i = 4;$i > 0;--$i) {
            $d[1][$i] = $k[$i];
        }
    }
    //画像URL取得部
    $dataurl = '';
    $sql = 'SELECT URL1 FROM '.$table." WHERE name='".$_SESSION['UserID']."'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $dataurl = $row['URL1'];
    }

    //リンクURL取得部
    $datalink = '';
    $sql = 'SELECT LINK1 FROM '.$table." WHERE name='".$_SESSION['UserID']."'";

    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $datalink = $row['LINK1'];
    }

    $array = explode(',', $dataurl);
    $dataurl = '';
    foreach ($array as $value) {
        if ($value == 12345678910) {
        } else {
            if (empty($dataurl)) {
                $dataurl = $value;
            } else {
                $dataurl = $dataurl.','.$value;
            }
        }
    }
    $sql = 'UPDATE '.$table." SET URL1='".$dataurl."' WHERE name='".$_SESSION['UserID']."'";
    $result = $pdo->query($sql);

    $array = explode(',', $datalink);
    $datalink = '';
    foreach ($array as $value) {
        if ($value == 12345678910) {
        } else {
            if (empty($datalink)) {
                $datalink = $value;
            } else {
                $datalink = $datalink.','.$value;
            }
        }
    }
    $sql = 'UPDATE '.$table." SET LINK1='".$datalink."' WHERE name='".$_SESSION['UserID']."'";
    $result = $pdo->query($sql);

    // echo $dataurl;
    // echo $datalink;

    $i = 1;
    $array = explode(',', $dataurl);
    foreach ($array as $value) {
        $num[$i] = $value;
        ++$i;
    }
    if (empty($dataurl)) {
        $count = 0;
    } else {
        $count = count($num);
    }

    //デモモードか判別する変数
    if ($_SESSION['UserID'] == $no_UserID) {
        $demo = 0;
        //デモ
    } else {
        $demo = 1;
        //ログインユーザー
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>GridGrid</title>
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
    <link rel="stylesheet" type="text/css" href="gridstr.css">
    <link rel="stylesheet" type="text/css" href="css/component.css">
    <script type="text/javascript" src="libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="libs/jquery/jquery-ui.js"></script>
    <script type="text/javascript" src="dist/jquery.gridster.js"></script>
    <script type="text/javascript" src="src/jquery.gridster.js"></script>
    <script type="text/javascript" src="gridstr.js"></script>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        // ga('create', 'UA-42391062-2', 'grid-grid.com');
        ga('create', 'UA-42391062-2',  { clientId: <?php echo "'".md5($a)."'"; ?> });
        ga('send', 'pageview');
    </script>
</head>


<?php

    $picadress = './user_image/';
    $sql = 'SELECT background FROM '.$table." WHERE name='".$_SESSION['UserID']."'";
    $result = $pdo->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $bgg = $row['background'];
    }

    echo "<div id='name' foo='".$a."'/>";
    echo "<div id='demo' foo='".$demo."'/>";
    echo "<div id='dataurl' foo='".$dataurl."'/>";
    echo "<div id='datalink' foo='".$datalink."'/>";
    ++$count;
    echo "<div id='count' foo='".$count."'/>";
    echo "<body style='background-image:url(".$picadress.$bgg.")'>";
?>

    <div id='cssmenu'>

        <span id="logo">GridGrid</span>
        <ul id="iconset">
            <li class="icons"><a class="md-trigger" id="options" data-modal="options-form" title="オプション"><img src="./img/appbar.tools.png" alt="オプション" width="30" height="30"></a></li>
            <li class="icons"><a class="md-trigger" id="add" data-modal="add-form" title="タイルを追加"><img src="./img/appbar.tiles.plus.png" alt="追加" width="30" height="30"></a></li>
            <?php
                if ($_SESSION['UserID'] == $no_UserID) {
                    //デモモード処理
/*                    echo '<li class="icons"><a class="signup" href="./login_tw.php">Twitterではじめる</a></li>';
                    echo '<li class="icons"><a class="signup" href="./login_fb.php">Facebookではじめる</a></li>';
                    echo '<li class="icons"><a class="signup" href="./login.php">旧ログイン</a></li>';
                    echo '<li class="icons"><a class="signup" href="./signup.php">旧新規登録</a></li>';*/
                } else {
                    //登録ユーザー処理
                    echo '<li class="icons"><a class="signup" href="./logout.php">ログアウト</a></li>';
                    //echo '<li class="icons"><a class="signup" href="#">'.$_SESSION["UserID"]."としてログイン中</a></li>";
                }
            ?>


        </ul>

    </div>

<div id="container">
<?php


    $array = explode(',', $dataurl);

    $i = 1;

    foreach ($array as $value) {
        $url[$i] = $value;
        // echo $url[$i]."<br>";
        ++$i;
    }

    $array = explode(',', $datalink);

    $i = 1;

    foreach ($array as $value) {
        $link[$i] = $value;
        // echo $link[$i]."<br>";
        ++$i;
    }
    $count = count($link);
    // echo "URLnum=".$count."<br>";


    $id = 1;
    //アイコン表示部分。DB内の画像URL、リンクURLを読み出して、順番に表示していく
    echo "<div class='layouts_grid' id='layouts_grid'>";
    echo '<ul>';

    for ($i2 = 1;$i2 < count($d);++$i2) {

        // echo $d[$i2][1];
        //ここが表示する際のコアの文

        echo "
        <li class='layout_block' data-id='".$id."' data-row='".$d[$i2][2]."' data-col='".$d[$i2][1]."' data-sizex='".$d[$i2][3]."' data-sizey='".$d[$i2][4]."'>
        <a href='".$link[$i2]."' target='_blank'><img src=".$picadress.$url[$i2]." width=100% height=100%></a>
        <div class='box'><div class='menu'>
        <div class='deleteme'><a  href='JavaScript:void(0);'><img src='./img/appbar.close.png' alt='削除' width='15' height='15'></a></div>
        </div></div>
        ";

        echo'</li>';

        ++$id;
    }

        echo '</ul>';
        echo '</div>';

?>
</div>

<!-- オプションフォーム -->
        <div class="md-modal md-effect-7" id="options-form">
            <div class="md-content">
                <h3>オプション</h3>
                <div>
                    <strong id="bgurl">背景画像  </strong><br>
                    <input type="text" name="bgpics" id="bgpics" class="text ui-widget-content ui-corner-all" placeholder="画像URLを入力" />
                    <div class="buttons">
                        <button class="apply">適用</button>
                        <button class="md-close">閉じる</button>
                    </div>

                </div>
            </div>
        </div>

<!-- タイル追加フォーム -->
        <div class="md-modal md-effect-7" id="add-form">
            <div class="md-content">
                <h3>タイルを追加</h3>
                <div>
                    <strong id="linkurl">サイトURL  </strong><br>
                    <input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" placeholder="サイトURLを入力" />
                    <br>
                    <strong id="picurl">画像URL  </strong><br>
                    <input type="text" name="pics" id="pics" class="text ui-widget-content ui-corner-all" placeholder="画像URLを入力" />

                <div class="buttons">
                    <button class="add">追加</button>
                    <button class="md-close">閉じる</button>
                </div>

                </div>
            </div>
        </div>

<!-- 以下モーダルウインドウ関連 -->
        <div class="md-overlay"></div><!-- the overlay element -->

        <!-- classie.js by @desandro: https://github.com/desandro/classie -->
        <script src="js/classie.js"></script>
        <script src="js/modalEffects.js"></script>

    <!-- for the blur effect -->
    <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
    <script>
        // this is important for IEs
        var polyfilter_scriptpath = '/js/';
    </script>
    <script src="js/cssParser.js"></script>
</body>
</html>
