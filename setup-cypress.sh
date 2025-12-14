#!/bin/bash

# Install Cypress and required plugins
echo "📦 Installing Cypress and dependencies..."
npm install cypress cypress-file-upload --save-dev

echo ""
echo "✅ Installation complete!"
echo ""
echo "Next steps:"
echo "1. Start Laravel: php artisan serve"
echo "2. Open Cypress: npx cypress open"
echo "3. Select a test file to run"
echo ""
echo "For more information, see:"
echo "- CYPRESS_QUICK_START.md (5-minute guide)"
echo "- README_TESTING.md (comprehensive guide)"
echo "- CYPRESS_SETUP_SUMMARY.md (this setup summary)"
