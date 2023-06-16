# Changelog
All notable changes to this project will be documented in this file.

### Adaptations
- Adaptations for running on PHP7.4 (the original version was for PHP8).
 - 2022-12-09

## [Unreleased]

## [1.2.0](https://github.com/michalsn/codeigniter-htmx/compare/v1.1.0...v1.2.0) - 2023-06-06

### Enhancements
- Add support for displaying the Debug Toolbar after `htmx` request.

### Changed
- The added JavaScript is now placed in the `head` tag.

## [1.1.0](https://github.com/michalsn/codeigniter-htmx/compare/v1.0.0...v1.1.0) - 2023-01-10

### Enhancements
- Add support for `htmx` and `boosted` param to the `IncomingRequest::is()` method.

## [1.0.0](https://github.com/michalsn/codeigniter-htmx/compare/v1.0.0-beta.2...v1.0.0) - 2022-12-09

### Enhancements
- When an HTTP error response occurs, display it in the modal.
- Add `view_fragment()` function to return only fragments of the view.

### Fixed
- Fixed the issue with applying an `ErrorDecorator` to the CLI requests.

## [1.0.0-beta.2](https://github.com/michalsn/codeigniter-htmx/compare/v1.0.0-beta...v1.0.0-beta.2) - 2022-11-22

### Changed
- Stop including code responsible for showing Debug Toolbar for `htmx` requests.

## 1.0.0-beta - 2022-11-19
First beta realease
