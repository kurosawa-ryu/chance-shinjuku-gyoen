# Chance Shinjuku Gyoen (CHANCE新宿御苑)

このプロジェクトは、ゲイ向けの風俗店（売り専）のホームページを制作するためのWordPressテーマおよびプラグイン開発リポジトリです。

## プロジェクト概要

WordPressをベースに、カスタムテーマとプラグインを開発し、効率的なウェブサイト運用を実現します。

### 主な機能

- キャスト（スタッフ）管理システム
- 予約フォーム
- 出勤スケジュール管理

## 開発環境について

### 前提条件
- 開発環境はMacOSを想定しています。
- homebrewのインストール
- Dockerの実行環境
  - mac 環境を想定しているためorbstackを推奨
- miseがインストールされていること

orbstack/ miseのセットアップに関しては末尾のapendixを参照してください。

### 開発環境のセットアップ

1. リポジトリをクローンする

```bash
git clone <repository-url>
cd chance-shinjuku
```

2. 本番管理画面からバックアップファイルを取得し、`dump/backup.wpress`に置く

3. 依存関係をインストールする

```bash
mise install
yarn install
composer install
```

4. Dockerをビルドする

```bash
docker compose build
```

5. 開発サーバーを起動する

```bash
docker compose up -d
```
初期データの用意が完了していれば、http://chance-shinjukugyoen.jp:8001 でアクセスが可能

6. (初回のみ)WordPressの初期データを用意する

```bash
docker-compose run wordpress /opt/script/init.sh
```

7. 開発サーバーを停止する

```bash
docker compose down
```

### Lint(構文チェック)実行方法

コードスタイルをチェックするには以下のコマンドを実行します：

```bash
# JavaScript/TypeScriptのリント
yarn lint:js

# SCSSのリント
yarn lint:css

# すべてのリント
yarn lint
```
### 開発環境でのメールの確認方法

Docker開発環境を起動するとmailpitが起動します。
以下URLから開発環境で送られたメールの確認が可能です。

http://localhost:19982

##  apendix

### orbstackのインストール
orbstackはMacOSでDockerを軽量で高パフォーマンスで実行できるツールです。  

以下の手順でインストールを行ってください。  

1.  以下コマンドをターミナルで実行してインストールしてください
```
brew install orbstack
```

2. orbstackを起動してください。
メニューバーに２重丸のようなアイコンが表示されたら起動完了です。

3. 以下のコマンドで動作確認ができます。
「Hello from Docker!」っとメッセージがたくさん出てきたら動作確認OKです
```
 docker run hello-world
```

### miseのインストール
miseは様々な言語やツールのバージョンを管理するソフトです。

以下の手順でインストールを行ってください。  
1 .  以下のコマンドを実行してください
```
brew install mise
echo 'eval "$(mise activate bash)"' >> ~/.zshrc
```
2. 以下のコマンドで動作確認ができます。
おしゃれな表示がされるとセットアップ完了です
```
mise -v
```
