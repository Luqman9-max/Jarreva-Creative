#!/bin/bash
# ============================================================
# Jarreva Creative — CDN Asset Builder
# ============================================================
# This script builds production frontend assets and prepares
# them for deployment to Cloudflare Pages.
#
# Usage:
#   chmod +x scripts/build-cdn.sh
#   ./scripts/build-cdn.sh
#
# The CDN directory will be created as a sibling to this project.
# Push that directory to a separate GitHub repo connected to
# Cloudflare Pages for automatic deployment.
# ============================================================

set -e

PROJECT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
CDN_DIR="${PROJECT_DIR}/../jarreva-frontend-assets"

echo "🔨 Building Vite assets..."
cd "$PROJECT_DIR"
npm run build

echo "📂 Preparing CDN directory: $CDN_DIR"
mkdir -p "$CDN_DIR"

# Clean previous build
rm -rf "$CDN_DIR/css" "$CDN_DIR/js" "$CDN_DIR/assets" "$CDN_DIR/images" "$CDN_DIR/vendor"

# Copy built CSS/JS assets
echo "📦 Copying built assets..."
cp -r "$PROJECT_DIR/public/build/assets" "$CDN_DIR/assets"

# Copy optimized images (WebP)
echo "🖼️  Copying optimized images..."
mkdir -p "$CDN_DIR/images/books"
cp "$PROJECT_DIR/public/images/books/"*.webp "$CDN_DIR/images/books/" 2>/dev/null || true
# Also copy JPG fallbacks
cp "$PROJECT_DIR/public/images/books/"*.jpg "$CDN_DIR/images/books/" 2>/dev/null || true

# Copy logos
cp "$PROJECT_DIR/public/logo.webp" "$CDN_DIR/" 2>/dev/null || true
cp "$PROJECT_DIR/public/logo.png" "$CDN_DIR/" 2>/dev/null || true

# Copy favicon
cp "$PROJECT_DIR/public/favicon.ico" "$CDN_DIR/" 2>/dev/null || true

# Self-host Three.js for reliability
echo "📥 Downloading Three.js for self-hosting..."
mkdir -p "$CDN_DIR/vendor"
curl -sL -o "$CDN_DIR/vendor/three.min.js" \
    "https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"

# Create Cloudflare Pages headers file
echo "📋 Creating cache headers..."
cat > "$CDN_DIR/_headers" << 'EOF'
# Immutable hashed assets — cache forever
/assets/*
    Cache-Control: public, max-age=31536000, immutable

# Images — cache for 30 days
/images/*
    Cache-Control: public, max-age=2592000

# Vendor libs — cache forever (versioned manually)
/vendor/*
    Cache-Control: public, max-age=31536000, immutable

# Logos and root assets — cache for 7 days
/logo.*
    Cache-Control: public, max-age=604800

# CORS — Allow all origins to reference these assets
/*
    Access-Control-Allow-Origin: *
    Access-Control-Allow-Methods: GET, HEAD, OPTIONS
EOF

# Summary
echo ""
echo "✅ CDN assets ready at: $CDN_DIR"
echo ""
echo "📊 Asset sizes:"
du -sh "$CDN_DIR/assets" 2>/dev/null || true
du -sh "$CDN_DIR/images" 2>/dev/null || true
du -sh "$CDN_DIR/vendor" 2>/dev/null || true
echo ""
echo "🚀 Next steps:"
echo "   1. cd $CDN_DIR"
echo "   2. git init && git add . && git commit -m 'Deploy assets'"
echo "   3. Push to GitHub repo connected to Cloudflare Pages"
echo "   4. Set ASSET_CDN_URL=https://your-project.pages.dev in Laravel .env"
echo "   5. Set ASSET_CDN_ENABLED=true in Laravel .env"
