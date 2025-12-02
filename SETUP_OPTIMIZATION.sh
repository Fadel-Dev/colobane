#!/bin/bash

# ⚡ SETUP OPTIMIZATION SCRIPT - NOFLAYLHUB
# Script pour appliquer l'optimisation de performance complète
# Usage: bash SETUP_OPTIMIZATION.sh

set -e

echo "🚀 OPTIMISATION PERFORMANCE - NOFLAYLHUB"
echo "=========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_step() {
    echo -e "${BLUE}▶ $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

# Step 1: Build optimization
print_step "Phase 1: Build Optimization"
echo "  Building with optimized Vite config..."
npm run build
print_success "Build completed!"
echo ""

# Step 2: Laravel caching
print_step "Phase 2: Laravel Caching"
echo "  Caching routes..."
php artisan route:cache
print_success "Routes cached!"

echo "  Caching configuration..."
php artisan config:cache
print_success "Configuration cached!"

echo "  Optimizing autoloader..."
composer install --optimize-autoloader --no-dev
print_success "Autoloader optimized!"
echo ""

# Step 3: Verify GZIP
print_step "Phase 3: Server Configuration"
if grep -q "mod_deflate" public/.htaccess; then
    print_success "GZIP compression configured!"
else
    print_warning "GZIP might not be configured in .htaccess"
fi
echo ""

# Step 4: Clear cache
print_step "Phase 4: Clearing Caches"
php artisan cache:clear
print_success "Application cache cleared!"

php artisan view:clear
print_success "View cache cleared!"

php artisan config:clear
print_success "Config cache cleared!"
echo ""

# Step 5: Verify setup
print_step "Phase 5: Verification"
echo "  Checking Node.js version:"
node --version
echo "  Checking PHP version:"
php --version | head -1
echo "  Checking Composer version:"
composer --version | head -1
echo ""

# Step 6: Summary
print_success "OPTIMIZATION SETUP COMPLETE! 🎉"
echo ""
echo -e "${GREEN}Next Steps:${NC}"
echo "1. Run Lighthouse audit: npm install -g lighthouse && lighthouse http://127.0.0.1:8000 --view"
echo "2. Implement lazy loading in your Vue components"
echo "3. Add eager loading to database queries"
echo "4. Monitor performance with Lighthouse regularly"
echo ""
echo -e "${BLUE}Documentation:${NC}"
echo "📖 PERFORMANCE_INDEX.md - Navigation guide"
echo "📖 RESUME_OPTIMISATION_100.md - Quick overview"
echo "📖 PERFORMANCE_QUICK_START.md - Implementation guide"
echo "📖 ULTIMATE_OPTIMIZATION_CHECKLIST.md - Complete checklist"
echo ""
echo -e "${GREEN}Let's make this app BLAZINGLY FAST! ⚡⚡⚡${NC}"

