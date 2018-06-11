<?php

header('Content-type: text/plain; charset=UTF-8');
ini_set('allow_url_fopen', 1);
require 'config.php';
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
} catch (PDOException $e) {
    die($e->getMessage());
}
//テーブル設定
$table = DB_TABLE;

$s = $_POST['val'];
$u = $_POST['name'];
echo '  ID='.$_POST['name'].'<br>';
echo '  tairu='.$_POST['val'].'<br>';
echo '  URL='.$_POST['url'].'<br>';
echo '  LINK='.$_POST['link'].'<br>';
$md = md5(time().$user);

    $sql = 'UPDATE '.$table." SET data='".$s."' WHERE name='".$u."'";

    $result = $pdo->query($sql);
    // echo 'The parameter of "request" is not found.';

if (isset($_POST['deleteid'])) {

    //画像URL取得部
    $dataurl = '';
    $sql = 'SELECT URL1 FROM '.$table." WHERE name='".$u."'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $dataurl = $row['URL1'];
    }

    require_once 'config.php';
    $URLdef = explode(',', $URL1000);
    $array = explode(',', $dataurl);
    $count = 0;
    foreach ($array as $value) {
        ++$count;
        if ($_POST['deleteid'] == $count) {
            if (in_array($value, $URLdef)) {
            } else {
                unlink('./user_image/'.$value);
            }
        }
    }

    //リンクURL取得部
    $datalink = '';
    $sql = 'SELECT LINK1 FROM '.$table." WHERE name='".$u."'";

    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $datalink = $row['LINK1'];
    }

    $array = explode(',', $dataurl);
    $i = 1;
    $newurl = '';
    foreach ($array as $value) {
        if ($i == $_POST['deleteid']) {
            $newurl = $newurl.'12345678910,';
        } else {
            $newurl = $newurl.$value.',';
            // echo $url[$i]."<br>";
        }
        ++$i;
    }
    $newurl = rtrim($newurl, ',');

    echo '   newurl='.$newurl;

    $sql = 'UPDATE '.$table." SET URL1='".$newurl."' WHERE name='".$u."'";
    $result = $pdo->query($sql);

    $array = explode(',', $datalink);
    $i = 1;
    $newlink = '';
    foreach ($array as $value) {
        if ($i == $_POST['deleteid']) {
            $newlink = $newlink.'12345678910,';
        } else {
            $newlink = $newlink.$value.',';
        }
        ++$i;
    }
    $newlink = rtrim($newlink, ',');
    echo '   newlink='.$newlink;

    $sql = 'UPDATE '.$table." SET LINK1='".$newlink."' WHERE name='".$u."'";
    $result = $pdo->query($sql);
}

if (isset($_POST['add'])) {
    //画像URL取得部
    $dataurl = '';
    $sql = 'SELECT URL1 FROM '.$table." WHERE name='".$u."'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $dataurl = $row['URL1'];
    }

    //リンクURL取得部
    $datalink = '';
    $sql = 'SELECT LINK1 FROM '.$table." WHERE name='".$u."'";

    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $datalink = $row['LINK1'];
    }

    $newurl = '';
    if (empty($dataurl)) {
        $newurl = $md.'.jpg';
    } else {
        $newurl = $dataurl.','.$md.'.jpg';
    }
    echo '   newurl='.$newurl;
    $sql = 'UPDATE '.$table." SET URL1='".$newurl."' WHERE name='".$u."'";
    $result = $pdo->query($sql);

    $newlink = '';
    if (empty($datalink)) {
        $newlink = $_POST['addlink'];
    } else {
        $newlink = $datalink.','.$_POST['addlink'];
    }
    echo '   newlink='.$newlink;
    $sql = 'UPDATE '.$table." SET LINK1='".$newlink."' WHERE name='".$u."'";
    $result = $pdo->query($sql);

    $i = 0;
    $array = explode(',', $newlink);
    foreach ($array as $value) {
        if ($value == '12345678910') {
        } else {
            ++$i;
        }
    }

    $url = $_POST['addurl'];
    $user = $_POST['name'];
    $folder = './user_image/'.$md.'.jpg';
    //$data = file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $data = curl_exec($ch);
    curl_close($ch);

    if (ceil(strlen($data) / 1024) < 50000) {
        file_put_contents($folder, $data);
    }
}
if (isset($_POST['bg'])) {
    $sql = 'UPDATE '.$table." SET background='".$md.".jpg' WHERE name='".$u."'";
    $result = $pdo->query($sql);

    $url = $_POST['bg'];
    $user = $_POST['name'];
    $folder = './user_image/'.$md.'.jpg';
    //$data = file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $data = curl_exec($ch);
    curl_close($ch);

    if (ceil(strlen($data) / 1024) < 50000) {
        file_put_contents($folder, $data);
    }
}
