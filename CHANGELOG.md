# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]

## [2025-08-05]

### Added
- Embed polls in newsletters: new modal on poll page provides ready-to-copy HTML for Beehiiv, Brevo, EmailOctopus, Ghost, HubSpot, Kit, Loops, MailerLite, and Sendy, each with the correct merge tag to prepopulate the contact email field for each subscriber.
- Copy-to-clipboard button for newsletter embed HTML, with support for rich markup.
- All new UI and strings are fully translatable and available in Spanish.

### Changed
- Poll voting page now allows prepopulating and clearing the contact_email field via URL and UI, improving the experience for newsletter recipients.

## [2025-08-04]

### Added
- Polls now use a unique, nullable ULID as an identifier.
- Poll creation automatically generates and saves a ULID for each new poll.
- Route model binding for polls now uses the ULID.
- Tests updated to assert that a ULID is generated for new polls.
- Poll responses now store the contact email address if provided.

### Changed
- Refactored poll option responses modal to use a single dynamic modal, opened programmatically with `Flux::modal()->show()`, improving maintainability and performance.
- Modal now loads responses dynamically from the backend when the ellipsis button is clicked.
- Improved poll voting UI: contact email field label and badge styling.
- All modal and poll voting UI strings are now translatable; added missing translations for Spanish, including for modal table and contact email field.
