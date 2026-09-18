#!/bin/bash
# ==============================================================================
# Script Otomatisasi Pull Git & Update Laravel di Terminal cPanel
# SMPS IT Ishlahul Ummah Prabumulih
#
# Cara Menjalankan di Terminal cPanel:
#   bash cpanel_pull.sh
# atau:
#   ./cpanel_pull.sh
# ==============================================================================

# Berhenti jika terjadi error fatal
set -e

# Warna untuk output terminal
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}======================================================${NC}"
echo -e "${BLUE}   MEMULAI PROSES PULL & UPDATE SMPIT ISHLAHUL UMMAH   ${NC}"
echo -e "${BLUE}======================================================${NC}"

# Tentukan lokasi direktori repository secara dinamis
TARGET_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$TARGET_DIR"

echo -e "${YELLOW}[1/6] Direktori kerja:${NC} $TARGET_DIR"

# 1. Tarik pembaruan terbaru dari GitHub (origin main)
echo -e "${YELLOW}[2/6] Mengambil pembaruan terbaru dari GitHub (origin main)...${NC}"
git fetch origin main
git reset --hard origin/main

# 2. Pastikan struktur folder storage & cache lengkap
echo -e "${YELLOW}[3/6] Menyiapkan struktur direktori storage & cache...${NC}"
mkdir -p storage/framework/sessions \
         storage/framework/views \
         storage/framework/cache/data \
         storage/logs \
         bootstrap/cache \
         public/uploads

if [ ! -f "storage/app/visitor_hits.txt" ]; then
    echo "0" > storage/app/visitor_hits.txt
fi

# 3. Set hak akses (permissions) yang aman untuk web server cPanel
echo -e "${YELLOW}[4/6] Mengatur hak akses folder (permissions)...${NC}"
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
chmod -R 755 public 2>/dev/null || true

# 4. Deteksi PHP CLI versi modern (PHP 8.2 / 8.3 / 8.4 cPanel ea-php)
PHP_BIN="php"
if [ -f "/usr/local/bin/ea-php84" ]; then
    PHP_BIN="/usr/local/bin/ea-php84"
elif [ -f "/usr/local/bin/ea-php83" ]; then
    PHP_BIN="/usr/local/bin/ea-php83"
elif [ -f "/usr/local/bin/ea-php82" ]; then
    PHP_BIN="/usr/local/bin/ea-php82"
fi
echo -e "${YELLOW}[5/6] Menggunakan PHP CLI:${NC} $($PHP_BIN -v 2>/dev/null | head -n 1 || echo 'php default')"

# 5. Jalankan Artisan migration & caching
echo -e "${YELLOW}[6/6] Membersihkan dan menyegarkan cache aplikasi...${NC}"
if [ -f "artisan" ]; then
    $PHP_BIN artisan optimize:clear || true
    $PHP_BIN artisan config:cache || true
    $PHP_BIN artisan route:cache || true
    $PHP_BIN artisan view:cache || true
    $PHP_BIN artisan migrate --force || true
    $PHP_BIN artisan db:seed --class=SchoolDataSeeder --force || true
    $PHP_BIN artisan storage:link || true
fi

# Sentuh index.php untuk me-reset OpCache server LiteSpeed / Apache
touch public/index.php 2>/dev/null || true

echo -e "${GREEN}======================================================${NC}"
echo -e "${GREEN}  SUKSES: Website berhasil di-pull & diperbarui!     ${NC}"
echo -e "${GREEN}======================================================${NC}"
