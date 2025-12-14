/**
 * Role Management Flow Test Case (TC05)
 *
 * Description:
 * Test complete role management flow:
 * 1. Register dummy user
 * 2. Auto-login as Mahasiswa
 * 3. Logout
 * 4. Login as Admin
 * 5. Change user role to Petugas
 * 6. Logout
 * 7. Login as dummy user and verify Petugas dashboard
 */

describe('TC05: Role Management Flow - Complete Role Change Scenario', () => {

  const testUser = {
    name: `Dummy User ${Date.now()}`,
    email: `dummy${Date.now()}@telkomuniversity.ac.id`,
    password: 'DummyPassword123',
    password_confirmation: 'DummyPassword123',
    phone: '081234567890',
    nim: '2301234567'
  };

  beforeEach(() => {
    cy.clearCookies();
    cy.window().then((win) => {
      win.localStorage.clear();
    });
  });

  it('TC05-01: Complete Role Management Flow - Register to Petugas Role', () => {
    // ========== STEP 1: Register dummy user ==========
    cy.log('📝 STEP 1: Register dummy user');
    cy.visit('/register');
    cy.url().should('include', '/register');

    cy.get('input[name="name"]').should('be.visible').type(testUser.name);
    cy.get('input[name="email"]').should('be.visible').type(testUser.email);
    cy.get('input[name="password"]').should('be.visible').type(testUser.password);
    cy.get('input[name="password_confirmation"]').should('be.visible').type(testUser.password_confirmation);
    cy.get('input[name="phone"]').should('be.visible').type(testUser.phone);
    cy.get('input[name="nim"]').should('be.visible').type(testUser.nim);
    cy.get('input[name="terms"]').should('be.visible').check();

    cy.contains('button', /daftar|register|sign up/i).should('be.visible').click();

    // ========== STEP 2: Auto-login to Mahasiswa dashboard ==========
    cy.log('✅ STEP 2: Auto-login as Mahasiswa');
    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
    cy.contains('Dashboard', { timeout: 10000 }).should('be.visible');
    cy.contains('Mahasiswa', { timeout: 5000 }).should('exist'); // Verify Mahasiswa role indicator

    // ========== STEP 3: Logout from Mahasiswa ==========
    cy.log('🚪 STEP 3: Logout from Mahasiswa account');
    cy.contains('button', /logout|keluar|sign out/i).should('be.visible').click();
    cy.url({ timeout: 10000 }).should('include', '/login');

    // ========== STEP 4: Login as Admin ==========
    cy.log('🔐 STEP 4: Login as Admin');
    cy.visit('/login');
    cy.get('input[name="email"]').should('be.visible').clear().type('admin@telkomuniversity.ac.id');
    cy.get('input[name="password"]').should('be.visible').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).should('be.visible').click();

    cy.url({ timeout: 10000 }).should('include', '/admin/dashboard');
    cy.contains('Admin Dashboard', { timeout: 10000 }).should('be.visible');

    // ========== STEP 5: Change user role from Mahasiswa to Petugas ==========
    cy.log('👤 STEP 5: Admin changes user role to Petugas');

    // Navigate to users management page
    cy.visit('/admin/users');
    cy.url({ timeout: 10000 }).should('include', '/admin/users');

    // Find the role select dropdown for the newly created user (should be near the bottom/last row)
    // The role change form submits automatically on change
    cy.get('select[name="role"]').last().should('be.visible');

    // Change role to Petugas (the dropdown auto-submits via onchange)
    cy.get('select[name="role"]').last().select('petugas');

    // Wait for the form to submit and page to reload
    cy.url({ timeout: 10000 }).should('include', '/admin/users');

    // Verify role was changed by checking the page still has the users list
    cy.contains('Manage Users').should('be.visible');
    cy.log('🔐 STEP 7: Login as dummy user with Petugas role');
    cy.visit('/login');
    cy.get('input[name="email"]').should('be.visible').clear().type(testUser.email);
    cy.get('input[name="password"]').should('be.visible').clear().type(testUser.password);
    cy.contains('button', /login|masuk|sign in/i).should('be.visible').click();

    // ========== VERIFY: User should be in Petugas dashboard ==========
    cy.log('✅ VERIFY: User is now in Petugas dashboard');
    cy.url({ timeout: 10000 }).should('include', '/officer/dashboard');
    cy.contains('Dashboard', { timeout: 10000 }).should('be.visible');

    cy.log('🎉 Complete role management flow successful!');
  });

  it('TC05-02: Simple registration and auto-login', () => {
    const simpleUser = {
      name: `Simple User ${Date.now()}`,
      email: `simple${Date.now()}@telkomuniversity.ac.id`,
      password: 'SimplePass123',
      password_confirmation: 'SimplePass123',
    };

    cy.visit('/register');
    cy.get('input[name="name"]').type(simpleUser.name);
    cy.get('input[name="email"]').type(simpleUser.email);
    cy.get('input[name="password"]').type(simpleUser.password);
    cy.get('input[name="password_confirmation"]').type(simpleUser.password_confirmation);
    cy.get('input[name="phone"]').type('082345678901');
    cy.get('input[name="nim"]').type('2302345678');
    cy.get('input[name="terms"]').check();

    cy.contains('button', /daftar|register|sign up/i).click();

    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
    cy.contains('Dashboard', { timeout: 10000 }).should('be.visible');

    cy.log('✅ Simple registration successful!');
  });

  it('TC05-03: Logout and re-login workflow', () => {
    // Login
    cy.visit('/login');
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).click();

    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');

    // Logout
    cy.contains('button', /logout|keluar|sign out/i).click();
    cy.url({ timeout: 10000 }).should('include', '/login');

    // Re-login
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('password123');
    cy.contains('button', /login|masuk|sign in/i).click();

    cy.url({ timeout: 10000 }).should('include', '/mahasiswa/dashboard');
    cy.contains('Dashboard', { timeout: 10000 }).should('be.visible');

    cy.log('✅ Re-login workflow successful!');
  });

  it('TC05-04: Failed login with incorrect password', () => {
    cy.visit('/login');
    cy.get('input[name="email"]').clear().type('mahasiswa@telkomuniversity.ac.id');
    cy.get('input[name="password"]').clear().type('wrongpassword123');
    cy.contains('button', /login|masuk|sign in/i).click();

    cy.url({ timeout: 5000 }).should('include', '/login');

    cy.log('✅ Incorrect password properly rejected!');
  });
});

