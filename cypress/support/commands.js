// cypress/support/commands.js
// Custom Cypress commands for Tel-U Assist testing

/**
 * Custom command to login as a student
 * Usage: cy.loginAsStudent()
 */
Cypress.Commands.add('loginAsStudent', () => {
  cy.visit('/login');
  cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
  cy.get('input[name="password"]').clear().type('password123');
  cy.get('button[type="submit"]').first().click();
  cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
});

/**
 * Custom command to login as admin
 * Usage: cy.loginAsAdmin()
 */
Cypress.Commands.add('loginAsAdmin', () => {
  cy.visit('/login');
  cy.get('input[name="email"]').clear().type('admin@telkomuniversity.ac.id');
  cy.get('input[name="password"]').clear().type('password123');
  cy.get('button[type="submit"]').first().click();
  cy.url({ timeout: 10000 }).should('include', '/admin/dashboard');
});

/**
 * Custom command to logout
 * Usage: cy.logout()
 */
Cypress.Commands.add('logout', () => {
  cy.get('form').within(() => {
    cy.get('button').contains(/logout|keluar|sign out/i).click({ force: true });
  }).then(() => {
    cy.url({ timeout: 10000 }).should('include', '/login');
  }).catch(() => {
    cy.visit('/logout');
    cy.url({ timeout: 10000 }).should('include', '/login');
  });
});

/**
 * Custom command to register a new user
 * Usage: cy.registerUser(userData)
 *
 * @param {Object} userData - User data
 * @param {string} userData.name - User full name
 * @param {string} userData.email - User email
 * @param {string} userData.password - User password
 * @param {string} userData.phone - User phone number
 * @param {string} userData.nim - Student NIM
 */
Cypress.Commands.add('registerUser', (userData) => {
  cy.visit('/register');
  cy.get('input[name="name"]').clear().type(userData.name);
  cy.get('input[name="email"]').clear().type(userData.email);
  cy.get('input[name="password"]').clear().type(userData.password);
  cy.get('input[name="password_confirmation"]').clear().type(userData.password);
  cy.get('input[name="phone"]').clear().type(userData.phone || '081234567890');
  cy.get('input[name="nim"]').clear().type(userData.nim || '2301234567');
  cy.get('button[type="submit"]').click();
});

/**
 * Custom command to create a report
 * Usage: cy.createReport(reportData)
 *
 * @param {Object} reportData - Report data
 * @param {string} reportData.title - Report title
 * @param {number} reportData.categoryId - Report category index
 * @param {number} reportData.locationId - Location index
 * @param {string} reportData.description - Report description
 * @param {string} reportData.photoFixture - Path to photo fixture file
 */
Cypress.Commands.add('createReport', (reportData) => {
  cy.visit('/report/create');
  cy.get('input[name="title"]').clear().type(reportData.title);
  cy.get('select[name="report_category_id"]').select(reportData.categoryId || 0);
  cy.get('select[name="location_id"]').select(reportData.locationId || 0);
  cy.get('textarea[name="description"]').clear().type(reportData.description);
  if (reportData.photoFixture) {
    // Use native selectFile (Cypress v10+) instead of attachFile
    cy.get('input[name="photo"]').selectFile(`cypress/fixtures/${reportData.photoFixture}`);
  }
  cy.contains('success', { timeout: 10000, matchCase: false }).should('be.visible');
});

/**
 * Custom command to wait for success message
 * Usage: cy.expectSuccessMessage('Report created successfully')
 *
 * @param {string} message - Success message to wait for
 */
Cypress.Commands.add('expectSuccessMessage', (message) => {
  cy.contains(message, { timeout: 10000 }).should('be.visible');
});

/**
 * Custom command to expect error message
 * Usage: cy.expectErrorMessage('required')
 *
 * @param {string} message - Error message to wait for
 */
Cypress.Commands.add('expectErrorMessage', (message) => {
  cy.get('body').should('contain.text', message);
});

/**
 * Preserve session across tests (for faster test execution)
 * Usage: cy.session('login', () => cy.loginAsStudent())
 */
Cypress.Commands.add('preserveSession', (key, loginCommand) => {
  cy.session(key, loginCommand);
});
