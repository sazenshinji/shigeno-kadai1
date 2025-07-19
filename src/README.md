## アプリケーション名
お客様お問い合わせアプリケーション

## 環境構築
　１．リポジトリの設定
　　1.1 CoachTechの開発環境テンプレートをクローン、ローカルリポジトリにリネーム
　　　(cd ~/coachtech/)
　　　(git clone git@github.com:coachtech-material/laravel-docker-template.git)
　　　(mv laravel-docker-template shigeno-kadai1)
　　1.2 リモートリポジトリの作成
　　　(Owner/Repository name：sazenshinji/shigeno-kadai1)
　　1.3 ローカルリポジトリとリモートリポジトリの紐づけ
　　　(git remote set-url origin 作成したリポジトリのurl)
　　1.4 ローカルリポジトリのデータをリモートリポジトリに反映
　　　(git add .)
　　　(git commit -m "コメント")
　　　(git push origin main)

　２．Docker の設定
　　・docker-compose up -d --build

　３．Laravel のパッケージのインストール
　　・docker-compose exec php bash
　　・composer install

　４．.env ファイルの作成
　　・cp .env.example .env
　　・.envファイルの修正

## 使用技術(実行環境)
　・Laravel 8.83.8
　・PHP 7.4.9 (cli) (built: Sep  1 2020 02:33:08) ( NTS )

## URL
　開発環境：http://localhost/

## ER図
![ER図](ER.drawio.png)
