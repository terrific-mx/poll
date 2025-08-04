# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]

## [2025-08-04]

### Added

- Polls now use a unique, nullable ULID as an identifier.
- Poll creation automatically generates and saves a ULID for each new poll.
- Route model binding for polls now uses the ULID.
- Tests updated to assert that a ULID is generated for new polls.
