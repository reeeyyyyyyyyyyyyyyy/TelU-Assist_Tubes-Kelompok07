# Cypress Setup Quick Start - Tel-U Assist

**Quick setup guide for Cypress E2E testing**

## ⚡ 5-Minute Setup

### 1. Install Dependencies
```bash
npm install cypress cypress-file-upload --save-dev
```

### 2. Create Fixture Image
```bash
# Run the fixture creation script
bash create-fixtures.sh

# OR manually create one:
# python3 -c "from PIL import Image; Image.new('RGB', (100, 100), 'blue').save('cypress/fixtures/sample.jpg')"
```

### 3. Verify Configuration
- Check `cypress.config.js` has correct baseUrl: `http://127.0.0.1:8000`
- Ensure Laravel is running: `php artisan serve`

### 4. Run Tests Interactively
```bash
npx cypress open
```

## 📋 Folder Structure Created
```
cypress/
├── e2e/
│   ├── crud_report.cy.js                 # Report creation tests
│   └── role_management_flow.cy.js        # User role management tests
├── fixtures/
│   └── sample.jpg                        # Test image (auto-created)
├── support/
│   ├── e2e.js                           # Test setup & plugins
│   └── commands.js                      # Custom Cypress commands
└── videos/                               # Test recordings (auto-created)
```

## ✅ Pre-requisites Check

Before running tests, ensure:

### ✓ Laravel is Running
```bash
php artisan serve
# Should output: Development Server started on [http://127.0.0.1:8000]
```

### ✓ Admin User Exists
```bash
php artisan tinker
>>> App\Models\User::where('email', 'admin@telkomuniversity.ac.id')->first()
```

### ✓ Test Student User Exists
```bash
php artisan tinker
>>> App\Models\User::create([
  'name' => 'Mahasiswa Test',
  'email' => 'mahasiswa@telkomuniversity.ac.id',
  'password' => bcrypt('password123'),
  'role' => 'mahasiswa',
  'phone' => '081234567890',
  'nim' => '2301234567'
])
```

### ✓ Locations & Categories Exist
```bash
php artisan tinker
>>> App\Models\Location::count()      # Should be > 0
>>> App\Models\ReportCategory::count() # Should be > 0
```

## 🚀 Run Tests

### Interactive Mode (Recommended)
```bash
npx cypress open
```
Then select a test file to run with live preview.

### Headless Mode (CI/CD)
```bash
# All tests
npx cypress run

# Specific test file
npx cypress run --spec "cypress/e2e/crud_report.cy.js"

# With specific browser
npx cypress run --browser firefox
```

## 📚 Test Files Description

### `crud_report.cy.js`
Tests for creating, validating, and submitting reports
- ✅ Create report with valid data
- ❌ Validation errors for empty fields
- ✅ Form displays all required fields
- ✅ Success message and redirect

### `role_management_flow.cy.js`
Tests for complete user role management workflow
- ✅ Register new user (default role: mahasiswa)
- ✅ Admin changes user role to petugas
- ✅ User sees correct dashboard based on role
- ❌ Prevent unauthorized access

## 🔧 Troubleshooting

### "Cannot find element" Error
```javascript
// Use longer timeout
cy.get('selector', { timeout: 15000 }).should('be.visible');

// Force click if needed
cy.get('selector').click({ force: true });
```

### "Request failed 404" on /login
```bash
# Verify Laravel routes
php artisan route:list | grep login

# Check routes/web.php has login route
grep -n "login" routes/web.php
```

### File upload not working
```bash
# Verify plugin is installed
npm list cypress-file-upload

# Check support/e2e.js has: require('cypress-file-upload/commands');
```

### Database state issues
```bash
# Reset database
php artisan migrate:refresh --seed

# Recreate admin user
php artisan db:seed --class=AdminUserSeeder
```

## 📖 Full Documentation

See `README_TESTING.md` for complete documentation including:
- Advanced configuration
- Custom commands usage
- CI/CD integration (GitHub Actions, GitLab CI)
- Performance optimization
- Debugging techniques

## 🎯 Next Steps

1. Run fixture creation: `bash create-fixtures.sh`
2. Start Laravel: `php artisan serve`
3. Open Cypress: `npx cypress open`
4. Select and run a test file
5. View test execution in browser
6. Check test videos in `cypress/videos/`

## 💡 Tips

- Use `cy.pause()` in tests to step through execution
- View Chrome DevTools during test execution (interactive mode)
- Slow down tests with `cy.wait(500)` if tests run too fast
- Use `cy.log()` for debug messages in test runner
- Check test videos for failures: `cypress/videos/`

---

**Ready to test?** Run: `npx cypress open`
