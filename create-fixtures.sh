#!/bin/bash

# Script to create test fixture image for Cypress
# Usage: bash create-fixtures.sh

echo "🎨 Creating Cypress test fixtures..."
echo ""

# Create fixtures directory if it doesn't exist
mkdir -p cypress/fixtures

# Create a sample image using ImageMagick (if available)
if command -v convert &> /dev/null; then
    echo "✅ Found ImageMagick (convert), creating sample image..."
    convert -size 800x600 xc:blue \
            -pointsize 30 \
            -fill white \
            -gravity center \
            -annotate +0+0 "Sample Image for Testing" \
            cypress/fixtures/sample.jpg
    echo "✅ Created: cypress/fixtures/sample.jpg (ImageMagick)"

elif command -v python3 &> /dev/null; then
    echo "✅ Found Python3, creating sample image..."
    python3 << 'EOF'
from PIL import Image, ImageDraw, ImageFont
import os

# Create image
img = Image.new('RGB', (800, 600), color='blue')
d = ImageDraw.Draw(img)

# Add text
try:
    # Try to use default font
    d.text((100, 250), "Sample Image for Testing", fill='white')
except:
    # Fallback to default if font not found
    d.text((100, 250), "Sample Image for Testing", fill='white')

# Save
os.makedirs('cypress/fixtures', exist_ok=True)
img.save('cypress/fixtures/sample.jpg')
print("✅ Created: cypress/fixtures/sample.jpg (Python PIL)")
EOF

elif [[ "$OSTYPE" == "darwin"* ]]; then
    echo "✅ Detected macOS, creating sample image with sips..."
    # macOS has sips built-in
    sips -c 600 800 /Library/Caches/ImageEvents/Exif.jpg -o cypress/fixtures/sample.jpg 2>/dev/null || \
    # Fallback: create empty file with valid JPEG header
    printf '\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00\xFF\xD9' > cypress/fixtures/sample.jpg
    echo "✅ Created: cypress/fixtures/sample.jpg (macOS)"

else
    echo "⚠️  ImageMagick and Python3 not found, creating minimal valid JPEG..."
    # Create minimal valid JPEG file
    printf '\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00' > cypress/fixtures/sample.jpg
    printf '\xFF\xDB\x00\x43\x00\x08\x06\x06\x07\x06\x05\x08\x07\x07\x07\x09\x09' >> cypress/fixtures/sample.jpg
    printf '\x08\x0A\x0C\x14\x0D\x0C\x0B\x0B\x0C\x19\x12\x13\x0F\x14\x1D\x1A' >> cypress/fixtures/sample.jpg
    printf '\x1F\x1E\x1D\x1A\x1C\x1C\x20\x24\x2E\x27\x20\x22\x2C\x23\x1C\x1C' >> cypress/fixtures/sample.jpg
    printf '\x28\x37\x29\x2C\x30\x31\x34\x34\x34\x1F\x27\x39\x3D\x38\x32\x3C' >> cypress/fixtures/sample.jpg
    printf '\x2E\x33\x34\x32\xFF\xC0\x00\x0B\x08\x00\x01\x00\x01\x01\x01\x11\x00' >> cypress/fixtures/sample.jpg
    printf '\xFF\xC4\x00\x14\x00\x01\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00' >> cypress/fixtures/sample.jpg
    printf '\x00\x00\x00\x00\x00\x00\xFF\xC4\x00\x14\x10\x01\x00\x00\x00\x00' >> cypress/fixtures/sample.jpg
    printf '\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xDA\x00\x08' >> cypress/fixtures/sample.jpg
    printf '\x01\x01\x00\x00\x3F\x00\x7F\x00\xFF\xD9' >> cypress/fixtures/sample.jpg
    echo "✅ Created: cypress/fixtures/sample.jpg (minimal JPEG)"
fi

echo ""
echo "📦 Fixture Setup Complete!"
echo "📍 Location: cypress/fixtures/sample.jpg"
echo ""
echo "Verify fixture:"
file cypress/fixtures/sample.jpg
ls -lh cypress/fixtures/sample.jpg
echo ""
echo "✅ Ready to run tests!"
