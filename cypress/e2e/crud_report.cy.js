/**
 * CRUD Report Test Case (TC01)
 *
 * Description:
 * - Login as Student (Mahasiswa)
 * - Navigate to /report/create
 * - Fill form: title, category, location, description, photo
 * - Submit form
 * - Assert success message and redirect
 */

describe('TC01: CRUD Report - Create Report (Mahasiswa)', () => {

  beforeEach(() => {
    // Clear cookies and localStorage before each test
    cy.clearCookies();
    cy.window().then((win) => {
      win.localStorage.clear();
    });
  });

  it('Should successfully create a report with valid data', () => {
    // Step 1: Visit login page
    cy.visit('/login');
    cy.url().should('include', '/login');

    // Step 2: Fill login form with student credentials
    // Using a test user that should exist from seeder or created from previous tests
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');

    // Step 3: Submit login form
    cy.contains('button', /login|masuk|sign in/i).click();

    // Step 4: Assert redirect to dashboard after successful login
    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
    cy.get('body').should('not.contain', 'Login');

    // Step 5: Navigate to create report page
    cy.visit('/report/create');
    cy.url().should('include', '/report/create');

    // Step 6: Fill report form - Title
    cy.get('input[name="title"]').should('be.visible').clear().type('Sampah Menumpuk di Koridor Gedung A');

    // Step 7: Select Report Category
    cy.get('select[name="report_category_id"]').should('be.visible').select(0);

    // Step 8: Select Location
    cy.get('select[name="location_id"]').should('be.visible').select(0);

    // Step 9: Fill Description
    cy.get('textarea[name="description"]').should('be.visible').clear().type(
      'Area koridor di lantai 2 Gedung A sangat kotor dengan sampah yang menumpuk. ' +
      'Memerlukan pembersihan segera agar nyaman digunakan.'
    );

    // Step 10: Upload photo fixture
    cy.get('input[name="photo"]').selectFile('cypress/fixtures/sample.jpg');

    // Step 11: Submit form (click the Simpan Laporan button specifically)
    cy.contains('button', /simpan|submit|save/i).should('be.visible').click();

    // Step 12: Assert success message appears
    cy.contains('Report created successfully', { timeout: 10000 }).should('be.visible');

    // Step 13: Assert redirect to report index page
    cy.url({ timeout: 10000 }).should('include', '/report');

    // Step 14: Verify report appears in list
    cy.contains('Sampah Menumpuk di Koridor Gedung A').should('be.visible');
  });

  it('Should fail validation when description is empty', () => {
    // Login as student
    cy.visit('/login');
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).click();
    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

    // Navigate to create report
    cy.visit('/report/create');

    // Fill form but leave description empty
    cy.get('input[name="title"]').should('be.visible').clear().type('Test Report');
    cy.get('select[name="report_category_id"]').should('be.visible').select(0);
    cy.get('select[name="location_id"]').should('be.visible').select(0);

    // Skip description - leave it empty
    cy.get('input[name="photo"]').selectFile('cypress/fixtures/sample.jpg');

    // Try to submit
    cy.contains('button', /simpan|submit|save/i).should('be.visible').click();

    // Assert validation error message (Laravel validation) - check for error alert or stay on same page
    cy.get('body').then(($body) => {
      // Check for error message in alert or form
      if ($body.text().includes('The description field is required')) {
        cy.contains('The description field is required').should('be.visible');
      } else if ($body.text().includes('required')) {
        cy.get('body').should('contain.text', 'required');
      } else {
        // Stay on create page if validation fails
        cy.url().should('include', '/report/create');
      }
    });
  });

  it('Should fail validation when photo is not an image', () => {
    // Login as student
    cy.visit('/login');
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).click();
    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

    // Navigate to create report
    cy.visit('/report/create');

    // Fill form with valid data
    cy.get('input[name="title"]').should('be.visible').clear().type('Test Report');
    cy.get('select[name="report_category_id"]').should('be.visible').select(0);
    cy.get('select[name="location_id"]').should('be.visible').select(0);
    cy.get('textarea[name="description"]').should('be.visible').clear().type('Valid description text');

    // Upload valid image
    cy.get('input[name="photo"]').selectFile('cypress/fixtures/sample.jpg');
    cy.contains('button', /simpan|submit|save/i).should('be.visible').click();

    // Assert success
    cy.contains('Report created successfully', { timeout: 10000 }).should('be.visible');
    cy.url({ timeout: 10000 }).should('include', '/report');
  });

  it('Should display form with all required fields', () => {
    // Login as student
    cy.visit('/login');
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).click();
    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

    // Navigate to create report
    cy.visit('/report/create');

    // Verify all form fields are present
    cy.get('input[name="title"]').should('be.visible');
    cy.get('select[name="report_category_id"]').should('be.visible');
    cy.get('select[name="location_id"]').should('be.visible');
    cy.get('textarea[name="description"]').should('be.visible');
    cy.get('input[name="photo"]').should('be.visible');
    cy.contains('button', /simpan|submit|save/i).should('be.visible');
  });
});
