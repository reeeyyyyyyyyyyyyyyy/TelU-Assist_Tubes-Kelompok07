# Tel-U Assist - Cypress E2E Testing Guide

**Project Name:** Tel-U Assist  
**Testing Framework:** Cypress v12+  
**Test Type:** End-to-End (E2E) Testing  
**Date Created:** December 2025  
**Author:** Senior QA Automation Engineer

---

## Table of Contents

1. [Overview](#overview)
2. [Prerequisites](#prerequisites)
3. [Installation & Setup](#installation--setup)
4. [Project Structure](#project-structure)
5. [Configuration](#configuration)
6. [Test Files](#test-files)
7. [Fixture Setup](#fixture-setup)
8. [Running Tests](#running-tests)
9. [Test Scenarios](#test-scenarios)
10. [CSRF Token Handling](#csrf-token-handling)
11. [Debugging & Troubleshooting](#debugging--troubleshooting)
12. [CI/CD Integration](#cicd-integration)

---

## Overview

This guide provides complete instructions for setting up and running Cypress E2E tests for the **Tel-U Assist** Laravel application. The test suite covers:

- **CRUD Report Operations** - Creating, reading, and managing cleanliness reports
- **Role Management Flow** - User registration, admin role assignment, and role-based dashboard redirection

### Test Coverage

| Test File | Scenarios | Description |
|-----------|-----------|-------------|
| `crud_report.cy.js` | 4 | Create reports, validate forms, verify success messages |
| `role_management_flow.cy.js` | 5 | Register users, change roles, verify dashboard redirection |

---

## Prerequisites

### System Requirements

- **Node.js**: v14.0.0 or higher
- **npm**: v6.0.0 or higher
- **macOS/Linux/Windows** (any OS supported by Cypress)
- **Laravel Application**: Running on `http://127.0.0.1:8000`

### Required Laravel Setup

1. Database seeded with admin user:
   - **Email:** `admin@telkomuniversity.ac.id`
   - **Password:** `password123`
   - **Role:** `admin`

2. Database seeded with test student user:
   - **Email:** `mahasiswa@telkomuniversity.ac.id`
   - **Password:** `password123`
   - **Role:** `mahasiswa`

3. At least one Location and Report Category in the database (seeded)

### Verify Laravel is Running

Before starting Cypress tests, ensure Laravel is running:

```bash
# Terminal 1 - Start Laravel development server
php artisan serve

# Expected output:
# Laravel development server started on http://127.0.0.1:8000
```

Verify by visiting `http://127.0.0.1:8000` in your browser.

---

## Installation & Setup

### Step 1: Install Cypress

Navigate to your project root directory and install Cypress:

```bash
cd /Users/rayyyhann/Documents/TestingPIS/TelU-Assist_Tubes-Kelompok07

# Install Cypress as a dev dependency
npm install cypress --save-dev
```

**Expected output:**
```
npm WARN save peer dep @cypress/webpack-dev-server@...
added XXX packages
```

### Step 2: Install Required Plugins

Install the Cypress File Upload plugin for handling file uploads in tests:

```bash
npm install --save-dev cypress-file-upload
```

### Step 3: Verify Installation

Check if Cypress is installed correctly:

```bash
npx cypress --version

# Expected output:
# Cypress 13.x.x
```

### Step 4: Configuration File

The `cypress.config.js` file is pre-configured with:
- **Base URL:** `http://127.0.0.1:8000`
- **Viewport:** 1280x720 (standard desktop)
- **Timeouts:** 10 seconds for commands and requests

No additional configuration is needed unless you change the Laravel port.

---

## Project Structure

```
TelU-Assist_Tubes-Kelompok07/
├── cypress/
│   ├── e2e/                          # Test specification files
│   │   ├── crud_report.cy.js        # Report CRUD test scenarios
│   │   └── role_management_flow.cy.js # User role management test scenarios
│   ├── fixtures/                     # Test data and images
│   │   └── sample.jpg               # Sample image for file upload tests
│   ├── support/                      # Helper files and plugins
│   │   ├── e2e.js                   # Global test hooks
│   │   └── commands.js              # Custom Cypress commands (optional)
│   └── videos/                       # Test recording videos (auto-generated)
├── cypress.config.js                 # Cypress configuration
├── package.json                      # NPM dependencies
└── README_TESTING.md                 # This file
```

---

## Configuration

### cypress.config.js

The default configuration is optimized for the Tel-U Assist application:

```javascript
const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://127.0.0.1:8000',              // Laravel server URL
    viewportWidth: 1280,                            // Browser width
    viewportHeight: 720,                            // Browser height
    defaultCommandTimeout: 10000,                   // 10 seconds
    requestTimeout: 10000,                          // 10 seconds for API requests
    responseTimeout: 10000,                         // 10 seconds for response
    setupNodeEvents(on, config) {
      // Node event listeners can be added here
    },
  },
});
```

### Changing the Base URL

If your Laravel server runs on a different port:

```javascript
// Change this line in cypress.config.js
baseUrl: 'http://127.0.0.1:3000',  // Example: port 3000
```

---

## Test Files

### 1. crud_report.cy.js

**Purpose:** Test CRUD operations for creating cleanliness reports

**Test Cases:**
- ✅ Successfully create a report with valid data
- ❌ Fail validation when description is empty
- ❌ Fail validation when photo format is invalid
- ✅ Display form with all required fields

**Key Assertions:**
```javascript
- Login with student credentials
- Navigate to /report/create
- Fill form fields: title, category, location, description, photo
- Submit form
- Verify success message: "Report created successfully"
- Verify redirect to /report (list page)
- Verify report appears in the list
```

### 2. role_management_flow.cy.js

**Purpose:** Test complete user role management workflow

**Test Cases:**
- ✅ Complete full flow: Register → Admin Change Role → Officer Login
- ✅ Register user and verify default role is Mahasiswa
- ✅ Allow admin to change user role from Mahasiswa to Petugas
- ❌ Prevent user from accessing pages with incorrect role

**Key Assertions:**
```javascript
- Register new user via /register
- Verify redirect to /mahasiswa/dashboard (Student dashboard)
- Logout user
- Login as admin@telkomuniversity.ac.id
- Navigate to /admin/users
- Find newly created user and change role to 'petugas'
- Verify success message
- Logout admin
- Login with new user credentials (now officer)
- Verify redirect to /officer/dashboard
```

---

## Fixture Setup

### Creating Test Images

The test suite requires a sample image for file upload tests.

**Option 1: Create a Simple Image Fixture (Recommended)**

```bash
# Navigate to fixtures directory
mkdir -p cypress/fixtures

# Create a minimal valid JPG image using ImageMagick (if installed)
convert -size 100x100 xc:blue cypress/fixtures/sample.jpg

# Or create using Python
python3 << 'EOF'
from PIL import Image
img = Image.new('RGB', (100, 100), color='blue')
img.save('cypress/fixtures/sample.jpg')
EOF
```

**Option 2: Download a Sample Image**

```bash
# Download a test image
cd cypress/fixtures
curl -o sample.jpg "https://via.placeholder.com/100"
cd ../..
```

**Option 3: Use an Existing Image**

```bash
# Copy an existing image from your system
cp ~/Pictures/sample.jpg cypress/fixtures/sample.jpg
```

### Verify Fixture Setup

```bash
# Check if fixture exists and is valid
ls -lh cypress/fixtures/sample.jpg

# Expected output:
# -rw-r--r--  1 user  group  1234 Dec 14 10:30 cypress/fixtures/sample.jpg
```

---

## Running Tests

### Interactive Test Runner (Recommended for Development)

Run Cypress in interactive mode with the Test Runner GUI:

```bash
# Open Cypress Test Runner
npx cypress open

# Or use npm script (if configured)
npm run test:e2e
```

**What you'll see:**
1. Cypress Launchpad opens
2. Select **"E2E Testing"**
3. Choose a browser (Chrome, Edge, or Firefox)
4. Select a test file from the list
5. Watch tests execute in real-time

### Headless Test Execution (CI/CD)

Run all tests in headless mode without GUI:

```bash
# Run all E2E tests
npx cypress run

# Run specific test file
npx cypress run --spec "cypress/e2e/crud_report.cy.js"

# Run with specific browser
npx cypress run --browser chrome
npx cypress run --browser firefox

# Run with video recording
npx cypress run --record
```

### Run Specific Test Suites

```bash
# Run only CRUD Report tests
npx cypress run --spec "cypress/e2e/crud_report.cy.js"

# Run only Role Management tests
npx cypress run --spec "cypress/e2e/role_management_flow.cy.js"

# Run with detailed output
npx cypress run --spec "cypress/e2e/crud_report.cy.js" --reporter spec
```

### Run Tests with Custom Configuration

```bash
# Change base URL temporarily
npx cypress run --config baseUrl=http://localhost:3000

# Increase timeouts
npx cypress run --config defaultCommandTimeout=15000

# Run tests on specific port
npx cypress run --port 8080
```

### npm Scripts (Optional - Add to package.json)

Add these scripts to your `package.json` for easier test execution:

```json
{
  "scripts": {
    "test:e2e": "cypress open",
    "test:e2e:run": "cypress run",
    "test:e2e:report": "cypress run --spec cypress/e2e/crud_report.cy.js",
    "test:e2e:role": "cypress run --spec cypress/e2e/role_management_flow.cy.js",
    "test:e2e:headless": "cypress run --headless"
  }
}
```

Then run:
```bash
npm run test:e2e              # Interactive mode
npm run test:e2e:run         # Headless mode
npm run test:e2e:report      # CRUD tests only
npm run test:e2e:role        # Role management tests only
```

---

## Test Scenarios

### Scenario 1: CRUD Report (TC01)

**Test ID:** `TC01-01`  
**Objective:** Verify mahasiswa can create a report with valid data

**Preconditions:**
- Student user logged in
- Laravel application running
- At least one location and report category seeded

**Steps:**
1. Login as `mahasiswa@telkomuniversity.ac.id` with password `password123`
2. Navigate to `/report/create`
3. Fill form:
   - **Title:** "Sampah Menumpuk di Koridor Gedung A"
   - **Category:** Select first category from dropdown
   - **Location:** Select first location from dropdown
   - **Description:** "Area koridor di lantai 2 Gedung A sangat kotor dengan sampah yang menumpuk."
   - **Photo:** Upload `cypress/fixtures/sample.jpg`
4. Click "Simpan Laporan" button
5. Verify success message and redirect

**Expected Result:**
✅ Form submits successfully  
✅ Message "Report created successfully" appears  
✅ User redirected to `/report` (list page)  
✅ New report visible in the list

---

### Scenario 2: User Registration (TC05-01)

**Test ID:** `TC05-01`  
**Objective:** New user registers and receives default role (Mahasiswa)

**Steps:**
1. Navigate to `/register`
2. Fill registration form:
   - **Name:** "Test User [timestamp]"
   - **Email:** "testuser[timestamp]@telkomuniversity.ac.id"
   - **Password:** "TestPassword123"
   - **Password Confirmation:** "TestPassword123"
   - **Phone:** "081234567890"
   - **NIM:** "2301234567"
3. Click register button
4. Verify redirect to student dashboard

**Expected Result:**
✅ User account created  
✅ Redirect to `/mahasiswa/dashboard`  
✅ User logged in automatically  
✅ User role is 'mahasiswa'

---

### Scenario 3: Admin Change User Role (TC05-02)

**Test ID:** `TC05-02`  
**Objective:** Admin can change user role from Mahasiswa to Petugas

**Preconditions:**
- Admin user logged in
- Test student user exists in database

**Steps:**
1. Navigate to `/admin/users`
2. Locate the test user in the table
3. Change role dropdown from "Mahasiswa" to "Petugas"
4. Form auto-submits (onchange event)
5. Verify success message appears

**Expected Result:**
✅ Success message displayed  
✅ User role updated in database  
✅ Role displayed as "Petugas" in table

---

### Scenario 4: Officer Dashboard Access (TC05-03)

**Test ID:** `TC05-03`  
**Objective:** User with Officer role sees Officer Dashboard

**Preconditions:**
- User role changed to 'petugas' by admin
- User logged out

**Steps:**
1. Login with officer credentials
2. Verify redirect to officer dashboard
3. Verify page contains officer-specific content

**Expected Result:**
✅ Redirect to `/officer/dashboard`  
✅ Dashboard displays officer-specific information  
✅ User cannot access student dashboard

---

## CSRF Token Handling

### Automatic CSRF Handling

Cypress automatically handles CSRF tokens when:

1. **Form Submissions:** Cypress includes cookies in form submissions
2. **Session Management:** Cookies are preserved across requests
3. **Same-Site Policy:** Works with Laravel's default CSRF protection

### Manual CSRF Token Handling (If Needed)

If you encounter CSRF token issues, implement custom command:

```javascript
// cypress/support/commands.js
Cypress.Commands.add('getCsrfToken', () => {
  return cy.request('/').then((response) => {
    const match = response.body.match(/name="_token"[^>]*value="([^"]*)"/);
    return match ? match[1] : null;
  });
});
```

### Verify CSRF Protection

To verify CSRF protection is working:

```bash
# Check if _token is present in HTML form
curl -s http://127.0.0.1:8000/register | grep -i "_token"

# Expected output:
# <input type="hidden" name="_token" value="AbCdEfGhIjKlMnOpQrStUvWxYz...">
```

---

## Debugging & Troubleshooting

### Common Issues & Solutions

#### Issue 1: "Cannot find element" Error

```
Error: cy.get() failed because the element does not exist in the DOM
```

**Solutions:**
```javascript
// Use longer timeout
cy.get('selector', { timeout: 15000 }).should('be.visible');

// Wait for element to be visible
cy.get('selector').should('exist');

// Use force click as last resort
cy.get('selector').click({ force: true });
```

#### Issue 2: 404 Not Found on /login

```
Error: Request failed with status code 404
```

**Solutions:**
```bash
# Verify Laravel is running
php artisan serve

# Check if routes/web.php has login route
grep -n "login" routes/web.php

# Check if auth middleware is configured
php artisan route:list | grep login
```

#### Issue 3: CSRF Token Mismatch

```
Error: CSRF token mismatch
```

**Solutions:**
```javascript
// Ensure cookies are sent with request
cy.visit('/login', {
  onBeforeLoad: (win) => {
    win.localStorage.clear();
  }
});

// Don't clear cookies before form submission
// Cypress preserves cookies automatically
```

#### Issue 4: File Upload Not Working

```
Error: cy.get('input[type="file"]').attachFile() is not a function
```

**Solutions:**
```bash
# Verify plugin is installed
npm list cypress-file-upload

# Install if missing
npm install --save-dev cypress-file-upload

# Verify support/e2e.js imports plugin
# Add: require('cypress-file-upload/commands');
```

#### Issue 5: Tests Pass Locally but Fail in CI/CD

**Common Causes:**
- Timing issues (race conditions)
- Environment-specific paths
- Database state differences

**Solutions:**
```javascript
// Use explicit waits
cy.url({ timeout: 15000 }).should('include', '/dashboard');

// Wait for network requests
cy.intercept('POST', '/report/store').as('createReport');
cy.get('button[type="submit"]').click();
cy.wait('@createReport');

// Add delays for slower CI environments
cy.get('button').click();
cy.wait(1000); // Add 1 second delay
```

### Enable Debug Mode

```bash
# Run with debug output
DEBUG=cypress:* npx cypress run

# Run with cy.debug() in tests
it('test', () => {
  cy.get('selector').debug();
});

# Run with cy.pause() to step through
it('test', () => {
  cy.pause();
  cy.get('selector');
});
```

### View Test Videos

After running headless tests, Cypress generates videos:

```bash
# Videos are saved to
cypress/videos/

# Watch the video
open cypress/videos/crud_report.cy.js.mp4
```

---

## CI/CD Integration

### GitHub Actions Example

Create `.github/workflows/e2e-tests.yml`:

```yaml
name: Cypress E2E Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: root
          MYSQL_DATABASE: telu_assist_test
        options: >-
          --health-cmd="mysqladmin ping"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=3

    steps:
      - uses: actions/checkout@v3
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mysql
      
      - name: Setup Node
        uses: actions/setup-node@v3
        with:
          node-version: '18'
      
      - name: Install dependencies
        run: |
          composer install --no-interaction
          npm install
      
      - name: Setup environment
        run: |
          cp .env.example .env.testing
          php artisan key:generate --env=testing
          php artisan migrate --env=testing
          php artisan db:seed --env=testing
      
      - name: Start Laravel server
        run: php artisan serve &
      
      - name: Run Cypress tests
        run: npx cypress run --headless
      
      - name: Upload videos
        if: failure()
        uses: actions/upload-artifact@v3
        with:
          name: cypress-videos
          path: cypress/videos/
```

### GitLab CI Example

Create `.gitlab-ci.yml`:

```yaml
e2e_tests:
  image: cypress/included:latest
  
  services:
    - mysql:8.0
  
  variables:
    MYSQL_ROOT_PASSWORD: root
    MYSQL_DATABASE: telu_assist_test
  
  before_script:
    - apt-get update && apt-get install -y php-cli php-mysql composer
    - composer install
    - npm install
    - php artisan serve &
    - sleep 5
  
  script:
    - npx cypress run --headless
  
  artifacts:
    paths:
      - cypress/videos/
    when: on_failure
```

---

## Best Practices

### Writing Effective Tests

1. **Use Descriptive Test Names**
   ```javascript
   ✅ it('Should successfully create a report with valid data')
   ❌ it('test report creation')
   ```

2. **Add Meaningful Comments**
   ```javascript
   // Step 1: Login as student
   cy.visit('/login');
   ```

3. **Use Custom Commands**
   ```javascript
   // cypress/support/commands.js
   Cypress.Commands.add('loginAsStudent', () => {
     cy.visit('/login');
     cy.get('input[name="email"]').type('mahasiswa@telkomuniversity.ac.id');
     cy.get('input[name="password"]').type('password123');
     cy.get('button[type="submit"]').click();
   });
   
   // Use in tests
   cy.loginAsStudent();
   ```

4. **Separate Concerns**
   ```javascript
   ✅ One test = One scenario
   ❌ One test = Multiple unrelated scenarios
   ```

5. **Use Data Attributes for Selection**
   ```html
   <!-- In your HTML -->
   <button data-cy="submit-report">Submit</button>
   ```
   
   ```javascript
   // In your test
   cy.get('[data-cy="submit-report"]').click();
   ```

### Performance Optimization

1. **Reuse Sessions**
   ```javascript
   beforeEach(() => {
     cy.preserveSessionCookie();
   });
   ```

2. **Parallel Execution**
   ```bash
   npx cypress run --parallel
   ```

3. **Run Only Failed Tests**
   ```bash
   npx cypress run --record --tag=ci
   ```

---

## Support & Resources

### Cypress Documentation
- [Official Docs](https://docs.cypress.io)
- [API Reference](https://docs.cypress.io/api/table-of-contents)
- [Best Practices](https://docs.cypress.io/guides/references/best-practices)

### Laravel Testing
- [Laravel Documentation](https://laravel.com/docs)
- [Authentication Testing](https://laravel.com/docs/testing#authenticated-requests)
- [CSRF Protection](https://laravel.com/docs/csrf)

### Troubleshooting Resources
- [Common Issues](https://docs.cypress.io/guides/references/troubleshooting)
- [Cypress GitHub Issues](https://github.com/cypress-io/cypress/issues)
- [Stack Overflow - Cypress Tag](https://stackoverflow.com/questions/tagged/cypress)

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | Dec 14, 2025 | Initial setup - CRUD Report & Role Management tests |

---

## Contact & Feedback

For questions or issues:
1. Check the [Debugging & Troubleshooting](#debugging--troubleshooting) section
2. Review test files for examples
3. Consult [Cypress Documentation](https://docs.cypress.io)
4. Check Laravel logs: `storage/logs/laravel.log`

---

**Last Updated:** December 14, 2025  
**Status:** ✅ Ready for Use
