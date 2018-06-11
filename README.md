### GridGrid
あなただけのスタートページを作る『GridGrid』 grid-grid.com

# README
リリース先：
http://grid-grid.com

## 概要
- 大学４年次に研究室同期と、さくらレンタルサーバのLAMP環境上に構築しリリース。
- SNSアカウントでログインして使えるブックマークサイト。
- ホームページに指定すれば、いつでもどこでも使えるブラウザのスタートページとして利用可能。
- 当時流行りの、Windows 8で採用されたModern UIを意識。
- サービスの詳細は、リリース先を参照。

## 環境、フレームワーク
- jQuery / gridster.js
  - http://dsmorse.github.io/gridster.js/
- JavaScript
- PHP 5.5
- MySQL 5.0.95
- Apache HTTP Server 2.2.3
- Linux
- phpMyadmin

## 使い方（ローカル環境）
- git clone XXXXXX.git
- cloneしたものをApache HTTP Serverのhtdocsに配置する
- `mysql_db_setup.sql`のSQLクエリーをphpMyadminなどで実行する
- `public_html/config.php`の設定内容を修正する
- webサーバーを起動し、localhostにアクセスする

## 工夫、こだわり、サービス志向
- SAP(Single Page Application)になるようPHPでの非同期処理を実装。
- 入力された画像URLに基づいて、自サーバ内に画像データを保管。
- ユニークユーザ数は、最大で40名。
- ユーザデータのバックアップは毎日深夜帯にバッチ処理は走るよう、自動化。
  - 当時はPHPMailerでメール送信で自動的にデータ転送を実施。
- ツクログに掲載。  
  GridGrid｜ツクログ - WEBサービスを無料でPRできるサービス
  http://creators.eightbit.jp/service/item876.html



以上です！
