<?php
session_name("GridStar");
session_start();

require_once('config.php');
require_once('twitteroauth/autoload.php');


use Abraham\TwitterOAuth\TwitterOAuth;

//TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

//コールバックURLをここでセット
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

//callbackで使うのでセッションに入れる
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

//Twitter.com 上の認証画面のURLを取得
$url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));

//Twitter.com の認証画面へリダイレクト
header( 'location: '. $url );

?>
