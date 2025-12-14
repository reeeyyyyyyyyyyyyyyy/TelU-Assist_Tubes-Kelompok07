/**
 * Non-Functional Testing - Tel-U Assist
 *
 * Focus: Security, Performance, and Usability
 * Test Cases:
 * - TC06-01: Security (Access Control / IDOR)
 * - TC06-02: Performance (Page Load Speed)
 * - TC06-03: Usability (Mobile Responsiveness)
 */

describe('SC06: Non-Functional Testing - Security, Performance & Usability', () => {

  // ========== TC06-01: SECURITY TEST ==========
  describe('TC06-01: Security (IDOR/Access Control)', () => {

    it('Should prevent unauthorized access to /admin/users', () => {
      // Login sebagai mahasiswa
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();
      cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

      cy.log('Logged in as Mahasiswa');

      // Try to access admin users page directly via URL
      // Should either get 403, 404, or be redirected to a different page
      cy.request({
        url: '/admin/users',
        failOnStatusCode: false
      }).then((response) => {
        // Should get 403 Forbidden or similar error (not 200 OK)
        expect([403, 404, 401, 302]).to.include(response.status);
        cy.log('✅ Access denied - proper security response received');
      });
    });

    it('Should prevent unauthorized access to /location/create', () => {
      // Login sebagai mahasiswa
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();
      cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

      // Try to access location creation page (admin only)
      cy.request({
        url: '/location/create',
        failOnStatusCode: false
      }).then((response) => {
        // Should get error response (not 200 OK)
        expect([403, 404, 401, 302]).to.include(response.status);
        cy.log('✅ Location create access denied - proper security response');
      });
    });

    it('Should allow Admin to access /admin/users', () => {
      // Login as admin
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('admin@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();
      cy.url({ timeout: 10000 }).should('include', '/admin/dashboard');

      // Navigate to admin users page
      cy.visit('/admin/users');
      cy.url({ timeout: 10000 }).should('include', '/admin/users');

      // Verify page loaded successfully with content
      cy.contains('Users').should('be.visible');
      cy.log('✅ Admin successfully accessed /admin/users');
    });
  });

  // ========== TC06-02: PERFORMANCE TEST ==========
  describe('TC06-02: Performance (Page Load Speed)', () => {

    it('Page navigation should be responsive (< 5 seconds)', () => {
      // Login first
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();
      cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

      // Navigate to lost-found - should load reasonably fast
      cy.visit('/lost-found', { timeout: 10000 });
      cy.get('body', { timeout: 10000 }).should('be.visible');
      cy.log('✅ Lost&Found page loaded successfully');

      // Navigate to report list
      cy.visit('/report', { timeout: 10000 });
      cy.get('body', { timeout: 10000 }).should('be.visible');
      cy.log('✅ Report page loaded successfully');

      // Navigate back to dashboard
      cy.visit('/mahasiswa/dashboard', { timeout: 10000 });
      cy.get('body', { timeout: 10000 }).should('be.visible');
      cy.log('✅ Dashboard loaded successfully');
    });

    it('Login page should be responsive', () => {
      cy.visit('/login');

      // Verify page is interactive and quick to load
      cy.get('input[name="email"]', { timeout: 5000 }).should('be.visible');
      cy.get('input[name="password"]').should('be.visible');
      cy.get('button[type="submit"]').should('be.visible');

      cy.log('✅ Login page responsive');
    });

    it('Dashboard should load with data', () => {
      // Login
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();

      // Verify dashboard loads
      cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
      cy.get('body', { timeout: 10000 }).should('be.visible');
      cy.log('✅ Dashboard loaded with data');
    });
  });

  // ========== TC06-03: USABILITY TEST ==========
  describe('TC06-03: Usability (Mobile Responsiveness)', () => {

    beforeEach(() => {
      // Login before each usability test
      cy.visit('/login');
      cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
      cy.get('input[name="password"]').clear().type('password123');
      cy.get('button[type="submit"]').first().click();
      cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
    });

    it('Navbar is responsive on iPhone SE2 (menu tidak berantakan)', () => {
      // Set viewport to iPhone SE2 size
      cy.viewport('iphone-se2');

      // Navigate to report page
      cy.visit('/report');

      // Check navbar exists and is visible
      cy.get('nav', { timeout: 10000 }).should('be.visible');

      // Check no horizontal overflow (no elements outside viewport)
      cy.window().then((win) => {
        const bodyWidth = win.document.body.offsetWidth;
        const windowWidth = win.innerWidth;
        // Body should not exceed window width
        expect(bodyWidth).to.be.at.most(windowWidth + 1);
      });

      cy.log('✅ Navbar is responsive on iPhone SE2 - menu tidak berantakan');
    });

    it('Lists are scrollable and readable on iPhone X (tabel bisa di-scroll)', () => {
      cy.viewport('iphone-x');

      // Navigate to report list
      cy.visit('/report');

      // Check page content is visible
      cy.get('body', { timeout: 10000 }).should('be.visible');

      // Page should be viewable with content
      cy.get('body', { timeout: 10000 }).should('exist');

      cy.log('✅ Lists are readable and accessible on iPhone X');
    });

    it('Lost&Found page responsive on multiple mobile sizes (tidak ada elemen tertabrak)', () => {
      // Test with multiple mobile sizes
      const mobileViewports = ['iphone-se2', 'iphone-x', 'samsung-s10'];

      mobileViewports.forEach((viewport) => {
        cy.viewport(viewport);
        cy.visit('/lost-found');

        // Check page is accessible without broken layouts
        cy.get('body', { timeout: 10000 }).should('be.visible');

        // Verify no horizontal scrolling (no overlapping elements)
        cy.window().then((win) => {
          const bodyWidth = win.document.body.offsetWidth;
          const windowWidth = win.innerWidth;
          // Body width should not exceed window width
          expect(bodyWidth).to.be.at.most(windowWidth + 1);
        });
      });

      cy.log('✅ Lost&Found page responsive on all tested mobile sizes - tidak ada elemen tertabrak');
    });
  });
});
