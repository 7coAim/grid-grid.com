<?php

//Site config
define('SITE_URL', 'http://grid-grid.com/');
define('SITE_URL_DIR', '/');

//DB config
define('DSN', 'mysql:host=ホスト名;dbname=データベース名');
define('DB_USER', 'データベースユーザ名');
define('DB_PASSWORD', 'データベースパスワード');
define('DB_TABLE', 'usertable');

//Facebook config
define('APP_ID', '取得したID');
define('APP_SECRET', '取得したシークレットkey');

//Twitter config
define('CONSUMER_KEY', '取得したKey');
define('CONSUMER_SECRET', '取得したシークレットkey');
define('OAUTH_CALLBACK', 'http://grid-grid.com/login_tw_callback.php');

//default data set
$data000 = '[{"x":1,"y":1,"width":2,"height":1,"id":"1","name":null},{"x":1,"y":4,"width":2,"height":1,"id":"2","name":null},{"x":1,"y":2,"width":2,"height":2,"id":"3","name":null},{"x":3,"y":1,"width":2,"height":2,"id":"4","name":null},{"x":5,"y":1,"width":2,"height":1,"id":"5","name":null},{"x":7,"y":1,"width":2,"height":1,"id":"6","name":null},{"x":6,"y":2,"width":1,"height":1,"id":"7","name":null},{"x":5,"y":2,"width":1,"height":1,"id":"8","name":null},{"x":3,"y":3,"width":2,"height":1,"id":"9","name":null},{"x":9,"y":1,"width":1,"height":1,"id":"10","name":null}]';

$LINK1000 = 'https://www.google.co.jp/,http://www.youtube.com/,https://twitter.com/,http://www.naver.jp/,http://www.facebook.com/,http://mail.google.com/mail/,http://www.nicovideo.jp/,http://b.hatena.ne.jp/,http://cloud.feedly.com/,http://www.amazon.co.jp/';

$URL1000 = '228be987d1b35aca0123ade4c9c95355.jpg,35bf5a7780e61d290c92a29f6fcb965b.jpg,27d728cf2e80985199f21d91ee5e4bdb.jpg,8e6f5fbbb7b1a45b0ce9b9e60ba2a147.jpg,647dffe5f6ef686416a74f5624eb5aff.jpg,9c7da6e0d640899119284fcf5b203827.jpg,413cacaaffc55c2af5283adef78e339c.png,2953308a065b49d7ce83be3cf1ae7432.jpg,213b972a58e39bdd9d7e26a186c148d5.jpg,de37aa90cad14c3843c0373a9d6a91a9.jpg';

$background000 = 'de1e002123e74400647c9878a98cbbf9.jpg';

//Other config
session_set_cookie_params(0, SITE_URL_DIR);
error_reporting(E_ALL & ~E_NOTICE);

?>