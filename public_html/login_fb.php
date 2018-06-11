<?php
session_name("GridStar");
session_start();
require_once('config.php');
//テーブル設定
$table=DB_TABLE;

if (empty($_GET['code'])) {
    // 認証の準備
    
    $_SESSION['state'] = sha1(uniqid(mt_rand(), true));
    
    $params = array(
        'client_id' => APP_ID,
        'redirect_uri' => SITE_URL.'login_fb.php',
        'state' => $_SESSION['state'],
        'scope' => 'user_website,friends_website'
    );
    
    $url = "https://www.facebook.com/dialog/oauth?".http_build_query($params);    
    
    // facebookに一旦飛ばす
    header('Location: '.$url);
    exit;

} else {
    // 認証後の処理
    
    // CSRF対策
    if ($_SESSION['state'] != $_GET['state']) {
        echo "不正な処理！";
        exit;
    }
    
    // ユーザー情報の取得
    $params = array(
        'client_id' => APP_ID,
        'client_secret' => APP_SECRET,
        'code' => $_GET['code'],
        'redirect_uri' => SITE_URL.'login_fb.php'
    );
    $url = 'https://graph.facebook.com/oauth/access_token?'.http_build_query($params);    
    $body = file_get_contents($url);
    parse_str($body);
    
    $url = 'https://graph.facebook.com/me?access_token='.$access_token.'&fields=name,picture';
    $me = json_decode(file_get_contents($url));
    //var_dump($me);
    //exit;
    
    // DB処理
    try {
        $dbh = new PDO(DSN,DB_USER,DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    
    $stmt = $dbh->prepare("select * from ".$table." where facebook_user_id=:user_id limit 1");
    $stmt->execute(array(":user_id"=>$me->id));
    $user = $stmt->fetch();

    if (empty($user)) {

        // 登録処理     
        $stmt = $dbh->prepare("insert into ".$table." (facebook_user_id, facebook_name, facebook_picture, facebook_access_token, created, modified, name, data, URL1, LINK1, background) values (:user_id, :name, :picture, :access_token, now(), now(), :name,'".$data000."', '".$URL1000."','".$LINK1000."','".$background000."');");
        $params = array(
            ":user_id"=>$me->id,
            ":name"=>$me->name,
            ":picture"=>$me->picture->data->url,
            ":access_token"=>$access_token
        );
        $stmt->execute($params);
        $stmt = $dbh->prepare("select * from ".$table." where id=:last_insert_id limit 1");
        $stmt->execute(array(":last_insert_id"=>$dbh->lastInsertId()));
        $user = $stmt->fetch();        
    }
    // var_dump($user);
    // exit;
    
    // ログイン処理
    if (!empty($user)) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        $_SESSION["UserID"]=$_SESSION['user']['facebook_name'];
    }
    
    // index.php
    header('Location: '.SITE_URL);

}


?>
