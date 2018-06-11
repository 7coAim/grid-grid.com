<?php
session_name("GridStar");
session_start();

require_once 'config.php';
require_once 'twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

//login_tw.phpでセットしたセッション
$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

//Twitterから返されたOAuthトークンと、あらかじめlogin_tw.phpで入れておいたセッション上のものと一致するかをチェック
if ((isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) || !isset($_REQUEST['oauth_token'])) {
    // ホームページへ遷移
    header('Location: '.SITE_URL);
    exit;
}

//OAuth トークンも用いて TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$_SESSION['access_token'] = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));


//セッションに入れておいたさっきの配列
$access_token = $_SESSION['access_token'];

//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

//ユーザー情報をGET
$me = $connection->get("account/verify_credentials");


    // データベースに格納
    
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    
    $table=DB_TABLE;
    $sql = "select * from ".$table." where tw_user_id = :id limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":id" => $me->id));
    $user = $stmt->fetch();

    if (!$user) {
        //登録処理
        $sql = "insert into ".$table." 
                (tw_user_id, tw_screen_name, tw_access_token, tw_access_token_secret, created, modified, name, data, URL1, LINK1, background) 
                values 
                (:tw_user_id, :tw_screen_name, :tw_access_token, :tw_access_token_secret, now(), now(), :tw_screen_name,'".$data000."', '".$URL1000."','".$LINK1000."','".$background000."')";
        $stmt = $dbh->prepare($sql);
        $params = array(
            ":tw_user_id" => $me->id_str,
            ":tw_screen_name" => $me->screen_name,
            ":tw_access_token" => $reply->oauth_token,
            ":tw_access_token_secret" => $reply->oauth_token_secret
        );
        $stmt->execute($params);
        
        $myId = $dbh->lastInsertId();
        $sql = "select * from ".$table." where id = :id limit 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":id" => $myId));
        $user = $stmt->fetch();    
    }
    
    // ログイン処理
    if (!empty($user)) {
        // セッションハイジャック対策
        session_regenerate_id(true);
        $_SESSION['me'] = $user;
        $_SESSION["UserID"]=$_SESSION['me']['tw_screen_name'];
    }
    
    // ホームに飛ばす
   header('Location: '.SITE_URL);

?>
