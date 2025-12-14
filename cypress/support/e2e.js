import './commands';

// Load cypress-file-upload plugin if available
try {
  require('cypress-file-upload/commands');
} catch (e) {
  console.warn('cypress-file-upload plugin not loaded, using native selectFile instead');
}
Cypress.on('uncaught:exception', (err, runnable) => {
  // Returning false here prevents Cypress from failing the test
  // Some applications may throw errors that we don't want to fail tests
  // Uncomment the return statement below if needed
  // return false;

  // By default, Cypress will fail the test on uncaught exceptions
});

// Set localStorage or sessionStorage data
beforeEach(() => {
  // Clear localStorage before each test to ensure clean state
  // cy.clearLocalStorage();
});

// Global command to wait for network requests
Cypress.Commands.add('waitForNetworkIdle', () => {
  cy.intercept('**').as('networkRequest');
  cy.wait(500);
});
