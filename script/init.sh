#!/usr/bin/env bash
set -euo pipefail

BACKUP_FILE_PATH=${BACKUP_FILE_PATH:-"/opt/dump/backup.wpress"}
WP_URL=${WP_URL:-"http://chance-yoyogi.jp:8001"}
WP_TITLE=${WP_TITLE:-"チャンス代々木"}
WP_ADMIN_USER=${WP_ADMIN_USER:-"admin"}
WP_ADMIN_PASSWORD=${WP_ADMIN_PASSWORD:-"admin"}
WP_ADMIN_EMAIL=${WP_ADMIN_EMAIL:-"admin@example.com"}

# バックアップファイルの存在を確認
if [ ! -f "$BACKUP_FILE_PATH" ]; then
  echo "バックアップファイルが存在しません"
  exit 1
fi

# wp-cliで既存のデータを削除
wp db drop --yes --allow-root

# wp-cliでテーブルを作成
wp db create --allow-root

# wp-cliでサイトの初期設定
wp core install --url=$WP_URL --title=$WP_TITLE --admin_user=$WP_ADMIN_USER --admin_password=$WP_ADMIN_PASSWORD --admin_email=$WP_ADMIN_EMAIL --skip-email --allow-root

# all in one migrationのインストール
wp plugin install all-in-one-wp-migration --activate --allow-root
wp plugin activate all-in-one-wp-migration-unlimited-extension --allow-root
# バックアップファイルのインポート
wp ai1wm restore $BACKUP_FILE_PATH --allow-root --yes
wp cache flush --allow-root
wp rewrite flush --allow-root
