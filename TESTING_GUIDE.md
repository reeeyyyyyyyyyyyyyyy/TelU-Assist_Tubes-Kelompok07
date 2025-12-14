# Panduan Testing Cypress - Tel-U Assist

Dokumen ini berisi panduan instalasi dan cara menjalankan skenario testing otomatis menggunakan Cypress.

## 1. Instalasi & Setup

1.  **Install Cypress via NPM:**
    ```bash
    npm install cypress --save-dev
    ```

2.  **Buka Cypress Pertama Kali (Generate Config):**
    ```bash
    npx cypress open
    ```
    * Pilih **E2E Testing**.
    * Pilih Browser (Chrome/Edge).
    * Cypress akan membuat folder `cypress/` dan file `cypress.config.js`.

3.  **Konfigurasi Base URL:**
    Buka file `cypress.config.js` dan ubah menjadi:
    ```javascript
    const { defineConfig } = require("cypress");

    module.exports = defineConfig({
      e2e: {
        baseUrl: '[http://127.0.0.1:8000](http://127.0.0.1:8000)', // Sesuaikan port laravel kamu
        setupNodeEvents(on, config) {
          // implement node event listeners here
        },
      },
    });
    ```

4.  **Siapkan Fixture Image:**
    Simpan satu gambar dummy (misal: `bukti.jpg`) ke dalam folder:
    `cypress/fixtures/bukti.jpg` (Digunakan untuk test upload).

## 2. Membuat Script Testing

Buat file baru di `cypress/e2e/telu_assist_spec.cy.js`:

```javascript
describe('Tel-U Assist Testing Scenarios', () => {

  // --- SCENARIO 1: CRUD REPORT ---
  it('Mahasiswa dapat membuat laporan kebersihan (CRUD)', () => {
    // 1. Login
    cy.visit('/login');
    cy.get('input[name="email"]').type('mahasiswa@telkomuniversity.ac.id'); // Pastikan user ini ada
    cy.get('input[name="password"]').type('password');
    cy.get('button[type="submit"]').click();

    // 2. Akses Create Report
    cy.visit('/reports/create');
    cy.get('textarea[name="description"]').type('Ada sampah menumpuk di koridor.');
    cy.get('select[name="location_id"]').select(1); // Pilih index ke-1
    
    // 3. Upload File (Pastikan plugin cypress-file-upload terinstall atau pakai selectFile di Cypress v10+)
    cy.get('input[name="image"]').selectFile('cypress/fixtures/bukti.jpg');

    // 4. Submit
    cy.get('button[type="submit"]').click();

    // 5. Assertion
    cy.url().should('include', '/reports');
    cy.contains('Laporan berhasil dibuat').should('be.visible');
  });

  // --- SCENARIO 2: ROLE MANAGEMENT FLOW ---
  it('Skenario Ubah Role: Register -> Admin Ubah Role -> Login Petugas', () => {
    const randomEmail = `dummy${Math.floor(Math.random() * 1000)}@test.com`;
    const password = 'password123';

    // STEP 1: Register User Baru
    cy.visit('/register');
    cy.get('input[name="name"]').type('User Dummy Testing');
    cy.get('input[name="email"]').type(randomEmail);
    cy.get('input[name="password"]').type(password);
    cy.get('input[name="password_confirmation"]').type(password);
    cy.get('button[type="submit"]').click();

    // STEP 2: Assert Masuk sebagai Mahasiswa
    cy.url().should('include', '/dashboard'); 
    cy.contains('Dashboard Mahasiswa').should('exist'); // Sesuaikan teks di view

    // STEP 3: Logout
    cy.get('.logout-btn').click(); // Pastikan tombol logout punya class/id ini

    // STEP 4: Login Admin
    cy.visit('/login');
    cy.get('input[name="email"]').type('admin@telkomuniversity.ac.id');
    cy.get('input[name="password"]').type('password');
    cy.get('button[type="submit"]').click();

    // STEP 5: Ubah Role User Tadi
    cy.visit('/admin/users');
    cy.contains(randomEmail).parent().find('.edit-btn').click(); // Logic klik tombol edit baris ybs
    cy.get('select[name="role"]').select('petugas');
    cy.get('button[type="submit"]').click();

    // STEP 6: Logout Admin
    cy.get('.logout-btn').click();

    // STEP 7: Login User Dummy Lagi
    cy.visit('/login');
    cy.get('input[name="email"]').type(randomEmail);
    cy.get('input[name="password"]').type(password);
    cy.get('button[type="submit"]').click();

    // STEP 8: Assert Redirect ke Dashboard Petugas
    cy.url().should('include', '/officer/dashboard');
    cy.contains('Dashboard Petugas').should('be.visible');
  });

});
