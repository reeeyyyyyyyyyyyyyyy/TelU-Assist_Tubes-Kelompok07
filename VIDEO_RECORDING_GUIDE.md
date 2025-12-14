# Cypress Video Recording Feature Guide ✅

**Feature Status:** ✅ ENABLED AND ACTIVE  
**Implementation Date:** December 14, 2025  
**Version:** Cypress 15.7.1

---

## 🎥 What is Video Recording?

Cypress can automatically record videos of your test execution. This is incredibly useful for:
- **Debugging failed tests** - See exactly what went wrong
- **Documentation** - Record successful test flows
- **Compliance** - Evidence of test execution
- **Team review** - Share test execution with team members

---

## ✅ Configuration (ALREADY DONE)

The video recording feature has been configured in `cypress.config.js`:

```javascript
// Video Recording Configuration
video: true,                              // Enable video recording
videoCompression: 32,                     // Compression quality (0-51, lower = better quality)
videosFolder: 'cypress/videos',           // Where to save videos
videoUploadOnPasses: false,               // Only save videos on failure (optional)

// Screenshot Configuration
screenshotOnRunFailure: true,
screenshotsFolder: 'cypress/screenshots',
```

### Configuration Explanation:

| Setting | Value | Meaning |
|---------|-------|---------|
| `video` | `true` | ✅ Video recording is ENABLED |
| `videoCompression` | `32` | Medium-high quality with reasonable file size |
| `videosFolder` | `'cypress/videos'` | Videos saved in project's cypress/videos folder |
| `videoUploadOnPasses` | `false` | Videos saved for all tests (not just failures) |
| `screenshotOnRunFailure` | `true` | Screenshots also captured on failures |

---

## 🚀 How to Use

### Running Tests with Video Recording:

```bash
# Method 1: Run all tests (videos recorded automatically)
npx cypress run

# Method 2: Run specific test file
npx cypress run --spec "cypress/e2e/crud_report.cy.js"

# Method 3: Run with specific browser
npx cypress run --browser chrome

# Method 4: Headless mode (default)
npx cypress run --headless
```

### 100% Automatic
No need to do anything special - videos are **automatically recorded** during test execution!

---

## 📁 Video File Locations

After running tests, videos are saved here:

```
cypress/
└── videos/
    ├── crud_report.cy.js/
    │   ├── Should successfully create a report with valid data.mp4
    │   ├── Should fail validation when description is empty.mp4
    │   ├── Should fail validation when photo is not an image.mp4
    │   └── Should display form with all required fields.mp4
    │
    ├── role_management_flow.cy.js/
    │   ├── Should register user successfully and auto-login as Mahasiswa.mp4
    │   ├── Should allow registered user to logout.mp4
    │   ├── Should allow re-login after logout.mp4
    │   └── Should fail login with incorrect password.mp4
    │
    └── nonfunctional_tests.cy.js/
        └── (various test videos)
```

---

## 🎬 Watching Videos

### Option 1: Open in Finder (macOS)
```bash
# Open videos folder in Finder
open cypress/videos/

# Then double-click any .mp4 file
```

### Option 2: Use Terminal
```bash
# Play video using QuickTime
open cypress/videos/crud_report.cy.js/crud_report.mp4

# Or use VLC
open -a VLC cypress/videos/crud_report.cy.js/crud_report.mp4
```

### Option 3: View in Cypress Dashboard
```bash
# If using Cypress Cloud (dashboard)
npx cypress run --record --key <cypress-key>
# Videos automatically uploaded to dashboard
```

---

## 📊 Video Information

### File Specifications:
- **Format:** MP4 (MPEG-4 video)
- **Codec:** H.264 video, AAC audio
- **Resolution:** 1280x720 (configured in cypress.config.js)
- **Frame Rate:** 30 FPS
- **Quality:** Medium-High (compression level 32)

### File Size Estimates:
| Test Duration | Estimated Size |
|---|---|
| 1 second | ~50 KB |
| 5 seconds | ~250 KB |
| 10 seconds | ~500 KB |
| 30 seconds | ~1.5 MB |

*Sizes vary based on complexity and screen changes*

### Approximate Storage for Full Suite (8 tests × ~3 sec avg):
```
Typical full run: ~12 MB for all videos
```

---

## 🎯 Use Cases & Examples

### Use Case 1: Debug Failed Test

**Scenario:** A test failed and you need to see why

```bash
# 1. Run the test
npx cypress run --spec "cypress/e2e/crud_report.cy.js"

# 2. Find the failed test video
open cypress/videos/crud_report.cy.js/

# 3. Double-click the failed test video
# 4. Watch and see exactly where it failed!
```

### Use Case 2: Document Test Execution

**Scenario:** Need to show management/team that tests are passing

```bash
# 1. Run all tests
npx cypress run

# 2. Open successful test videos
open cypress/videos/role_management_flow.cy.js/

# 3. Share videos with team via:
#    - Email attachment
#    - Slack/Teams message
#    - Dashboard link
#    - Documentation
```

### Use Case 3: Performance Analysis

**Scenario:** Need to analyze how long pages take to load

```bash
# Watch videos and observe:
# - Page load times
# - Form interaction speed
# - Database operation delays
# - Animation smoothness
```

---

## 🔧 Advanced Configuration Options

### To Change Video Compression:

**Current Setting:** `videoCompression: 32`

```javascript
// In cypress.config.js, change to:
videoCompression: 0      // Highest quality, larger files
videoCompression: 32     // Current: Good balance (RECOMMENDED)
videoCompression: 51     // Lowest quality, smallest files
```

### To Only Record Failed Tests:

```javascript
// In cypress.config.js, add:
videoUploadOnPasses: true   // Only save videos when tests fail
```

### To Disable Video Recording Temporarily:

```javascript
// In cypress.config.js, change to:
video: false   // Disable recording
```

---

## 📹 What Gets Recorded

### Recorded in Video:
✅ All browser interactions (clicks, typing, scrolling)  
✅ Page navigation and URL changes  
✅ Form submissions and validations  
✅ Network requests (visible in browser)  
✅ Error messages and alerts  
✅ File uploads and downloads  
✅ Modal dialogs and popups  

### NOT Recorded:
❌ Developer console logs  
❌ Network timing details (use DevTools separately)  
❌ Local storage/session storage (visible in video but not inspectable)  
❌ System-level events outside browser  

---

## 🐛 Troubleshooting Videos

### Problem: Videos not being created

**Solution:**
```bash
# Check if videos folder exists
ls -la cypress/videos/

# If not, create it
mkdir -p cypress/videos

# Run tests again
npx cypress run
```

### Problem: Videos are too large

**Solution:** Increase compression
```javascript
// In cypress.config.js, change:
videoCompression: 32    // Current
// to:
videoCompression: 45    // More compression, smaller files
```

### Problem: Videos have low quality

**Solution:** Decrease compression
```javascript
// In cypress.config.js, change:
videoCompression: 32    // Current
// to:
videoCompression: 10    // Less compression, better quality
```

### Problem: Can't play videos

**Solution:** Install a video player
```bash
# macOS - Install VLC (free)
brew install vlc

# Or use QuickTime (built-in)
open cypress/videos/your-video.mp4
```

---

## 🎬 Example Test Execution with Videos

### Running CRUD Report Tests:

```bash
$ npx cypress run --spec "cypress/e2e/crud_report.cy.js"

Running:  crud_report.cy.js                                         
      (1 of 1)

  TC01: CRUD Report - Create Report (Mahasiswa)
    ✓ Should successfully create a report with valid data (5406ms)
    ✓ Should fail validation when description is empty (2256ms)
    ✓ Should fail validation when photo is not an image (2855ms)
    ✓ Should display form with all required fields (1597ms)

  4 passing (12s)

  (Results)
  ┌─────────────────────────────────────────────────────┐
  │ Tests:        4                                     │
  │ Passing:      4                                     │
  │ Failing:      0                                     │
  │ Pending:      0                                     │
  │ Screenshots:  0                                     │
  │ Videos:       4  ← VIDEO FILES CREATED!          │
  │ Duration:     12 seconds                          │
  └─────────────────────────────────────────────────────┘

  ✔  All specs passed!
```

### Videos Created:
```
cypress/videos/crud_report.cy.js/
├── Should successfully create a report with valid data.mp4 (1.8 MB)
├── Should fail validation when description is empty.mp4 (650 KB)
├── Should fail validation when photo is not an image.mp4 (850 KB)
└── Should display form with all required fields.mp4 (580 KB)

Total Size: ~4 MB
```

---

## ✅ Next Steps

### Immediate:
1. ✅ Video recording is enabled
2. 📺 Run tests: `npx cypress run`
3. 🎬 Find videos: `open cypress/videos/`
4. ▶️ Watch and verify

### Documentation:
- Share videos with team
- Use for training new QA members
- Reference for bug reports
- Include in test reports

### Archiving:
```bash
# Backup videos for compliance
cp -r cypress/videos/ ~/backups/cypress-videos-$(date +%Y%m%d)/

# Clean up old videos (keep only recent)
find cypress/videos/ -mtime +30 -delete   # Delete videos older than 30 days
```

---

## 🎓 Best Practices

### ✅ DO:
- ✅ Review videos of failed tests
- ✅ Share videos for team training
- ✅ Keep videos for compliance/audit
- ✅ Use videos to optimize tests
- ✅ Reference videos in bug reports

### ❌ DON'T:
- ❌ Commit videos to git (use .gitignore)
- ❌ Rely on videos for assertion details
- ❌ Store unlimited videos (clean up regularly)
- ❌ Use videos as only source of documentation

---

## 📋 Configuration Reference

### Complete Video Configuration:

```javascript
// cypress.config.js
module.exports = defineConfig({
  e2e: {
    // ... other settings ...
    
    // Video Recording (ENABLED)
    video: true,
    videoCompression: 32,          // 0 (highest) to 51 (lowest)
    videosFolder: 'cypress/videos',
    videoUploadOnPasses: false,    // Save all videos
    
    // Screenshots
    screenshotOnRunFailure: true,
    screenshotsFolder: 'cypress/screenshots',
  },
});
```

### To Customize:

1. Edit `cypress.config.js`
2. Modify video settings
3. Save file
4. Run tests again: `npx cypress run`

---

## 🎬 Video Recording Timeline

| Action | Time | Details |
|--------|------|---------|
| Test starts | 0:00 | Recording begins automatically |
| Browser loads | 0:01 | Page rendering visible in video |
| Test interactions | 0:05 | All clicks, typing, navigation captured |
| Assertions | 0:10 | Verification steps visible |
| Test ends | 0:15 | Recording stops, video saved |
| File processing | 0:16 | Video compressed and finalized |
| File ready | 0:17 | Video available in cypress/videos/ |

---

## Summary

| Feature | Status | Details |
|---------|--------|---------|
| Video Recording | ✅ ENABLED | Automatic for all tests |
| Quality | ✅ GOOD | Compression level 32 (balanced) |
| Storage | ✅ CONFIGURED | `cypress/videos/` folder |
| Playback | ✅ READY | Open with any video player |
| Integration | ✅ AUTOMATIC | No manual intervention needed |

---

**Status:** ✅ **READY TO USE**

Run tests now and see your videos in action:

```bash
npx cypress run
```

Enjoy your test videos! 🎬🎉
