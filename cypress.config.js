const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://127.0.0.1:8000',
    viewportWidth: 1280,
    viewportHeight: 720,
    defaultCommandTimeout: 10000,
    requestTimeout: 10000,
    responseTimeout: 10000,

    // Video Recording Configuration
    video: true,                              // Enable video recording
    videoCompression: 32,                     // Compression quality (0-51, lower = better quality)
    videosFolder: 'cypress/videos',           // Where to save videos
    videoUploadOnPasses: false,               // Only upload videos on failure (optional)

    // Screenshot Configuration
    screenshotOnRunFailure: true,
    screenshotsFolder: 'cypress/screenshots',

    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },
});
