# Release Notes

## [6.3.2](https://github.com/timirey/xapi-php/compare/6.3.1..6.3.2) - 2025-01-06

- Prevent duplicated response on streaming session.

## [6.3.1](https://github.com/timirey/xapi-php/compare/6.3.0..6.3.1) - 2025-01-06

- Update PHP Doc for PHP Stan compliance.

## [6.3.0](https://github.com/timirey/xapi-php/compare/6.2.0..6.3.0) - 2025-01-06

- Add new `topics` param to `NewsStreamRecord`.

## [6.2.0](https://github.com/timirey/xapi-php/compare/6.1.0..6.2.0) - 2024-12-27

- Add new `QuoteId` and `MarginMode`.

## [6.1.0](https://github.com/timirey/xapi-php/compare/6.0.5..6.1.0) - 2024-12-27

- Remove timeout for stream connection.

## [6.0.5](https://github.com/timirey/xapi-php/compare/6.0.4..6.0.5) - 2024-12-21

- Remove git workflow for pull requests.

## [6.0.4](https://github.com/timirey/xapi-php/compare/6.0.3..6.0.4) - 2024-11-24

- Update `.gitattributes`.

## [6.0.3](https://github.com/timirey/xapi-php/compare/6.0.2..6.0.3) - 2024-07-30

- Remove `isConnected()` from `SocketConnection::class`.
- Updated GitHub workflows for better checks.

## [6.0.2](https://github.com/timirey/xapi-php/compare/6.0.1..6.0.2) - 2024-07-30

- Catch exceptions from `stream_socket_client()`.

## [6.0.1](https://github.com/timirey/xapi-php/compare/6.0.0..6.0.1) - 2024-07-30

- Fixed `SocketConnection` exception messages to be more informative.

## [6.0.0](https://github.com/timirey/xapi-php/compare/5.0.0..6.0.0) - 2024-07-30

### Added

- Integrated phpstan into `composer.json` and workflows alongside Pest.
- Updated to support PHP 8.3 as a minimum requirement.
- Created interfaces for connection, response, and payload.

### Changed

- Simplified with a single function and necessary parameters.
- Merged DEMO and REAL connections with a type string.
- Combined client creation and authentication.
- Updated methods (e.g., `GetTickPrices` to `SubscribeTickPrices`) and merged `Client` and `StreamClient`.
- Removed `new static()` dependency; made methods non-dependent or final.
- Updated, reduced size, and used `@inheritdoc`.
- Made responses readonly.
- Marked appropriate classes as `final`.
- Ensured camelCase for class properties.
- Refactored `AbstractResponse`.
- Added where required.
- Freed up constructors, moved logic to methods.
- Refactored `$this->parameters` in payloads and `$response['returnData']` in responses.
- Updated commands and error section.

### Removed

- Merged `Client` and `StreamClient` to avoid multiple object creations.

## [5.0.0](https://github.com/timirey/xapi-php/compare/4.0.1..5.0.0) - 2024-07-17

-Changed the way client inits, `$userId` and `$password` are directly sent in the payload.

## [4.0.1](https://github.com/timirey/xapi-php/compare/4.0.0..4.0.1) - 2024-07-16

-Fix stream listener by adding `feof()` check.

## [4.0.0](https://github.com/timirey/xapi-php/compare/3.0.0..4.0.0) - 2024-07-16

-Dropped minimum support to 8.1 PHP.
-Added buffer to make sure it reads all the way down to `"\n\n"` guaranteed response separator.

## [3.0.0](https://github.com/timirey/xapi-php/compare/2.0.1...3.0.0) - 2024-07-16

-Add minimum support of 8.3 PHP.
-Use `json_validate()` when parsing response.

## [2.0.1](https://github.com/timirey/xapi-php/compare/2.0.0...2.0.1) - 2024-07-16

-See issue [#32](https://github.com/timirey/xapi-php/issues/32).

## [2.0.0](https://github.com/timirey/xapi-php/compare/1.2.1...2.0.0) - 2024-07-15

-Added stream commands.
-Removed WebSocket dependency (now it uses native php sockets).

## [2.0.0-rc2](https://github.com/timirey/xapi-php/compare/2.0.0-rc...2.0.0-rc2) - 2024-07-15

-Removed WebSocket package dependency.
-Instead of WebSocket it uses [php sockets](https://www.php.net/manual/en/book.sockets.php).
-Updated tests.

## [2.0.0-rc](https://github.com/timirey/xapi-php/compare/2.0.0-alpha...2.0.0-rc) - 2024-07-09

-Added documentation for streaming commands.
-Updated code style and php doc blocks.
-Updated Pest tests to include more instance check-ups.
-Property names have changed to adapt standards.

## [2.0.0-alpha](https://github.com/timirey/xapi-php/compare/1.2.1...2.0.0-alpha) - 2024-07-08

-Added support for streaming communication.
-Added [streaming commands](http://developers.xstore.pro/documentation/#available-streaming-commands).
-Changed back from Pint to PHP CS.
-Backwards incompatible changes.

## [1.2.1](https://github.com/timirey/xapi-php/compare/1.2.0...1.2.1) - 2024-07-04

-Fix DateTime objects in Pest tests.

## [1.2.0](https://github.com/timirey/xapi-php/compare/1.1.0...1.2.0) - 2024-07-04

-Add Pint with PSR12.
-Refactor Pest tests.

## [1.1.0](https://github.com/timirey/xapi-php/compare/1.0.1...1.1.0) - 2024-07-02

-Add new exceptions and improved error handling.

## [1.0.1](https://github.com/timirey/xapi-php/compare/1.0.0...1.0.1) - 2024-07-02

-Some small changes to README.md and GitHub workflows.

## [1.0.0](https://github.com/timirey/xapi-php/compare/0.7.2.2...1.0.0) - 2024-07-02

-Add documentation.
-Add dev tools.
-Add non-streaming commands and tests.
-Add PHPDoc blocks on every property, method and class.
-Update folder structure.
-Add enums for host, payloads and responses.

## [1.0.0-rc.3](https://github.com/timirey/xapi-php/compare/1.0.0-rc.2...1.0.0-rc.3) - 2024-07-02

-Update CHANGELOG.md, composer.json and README.md.

## [1.0.0-rc.2](https://github.com/timirey/xapi-php/compare/1.0.0-rc...1.0.0-rc.2) - 2024-07-02

-Adjusted README.md with documentation.

## [1.0.0-rc](https://github.com/timirey/xapi-php/compare/1.0.0-beta...1.0.0-rc) - 2024-07-01

-Prepare for release.

## [1.0.0-beta](https://github.com/timirey/xapi-php/compare/1.0.0-alpha.2...1.0.0-beta) - 2024-07-01

-Refactor adding DateTime instead of int.
-Updated tests.

## [1.0.0-alpha.2](https://github.com/timirey/xapi-php/compare/1.0.0-alpha...1.0.0-alpha.2) - 2024-07-01

-Refactored types for enum usage.

## [1.0.0-alpha](https://github.com/timirey/xapi-php/compare/0.7.2.2...1.0.0-alpha) - 2024-06-30

-Add main commands for non-stream web socket.
-Add test coverage (featuring mocks) for each command.

## [0.7.2.2](https://github.com/timirey/xapi-php/compare/0.7.2.1...0.7.2.2) - 2024-06-28

-Fix linter issues.

## [0.7.2.1](https://github.com/timirey/xapi-php/compare/0.7.2...0.7.2.1) - 2024-06-28

-Rename workflow.

## [0.7.2](https://github.com/timirey/xapi-php/compare/0.7.1...0.7.2) - 2024-06-28

-Update .gitignore.

## [0.7.1](https://github.com/timirey/xapi-php/compare/0.7.0...0.7.1) - 2024-06-28

-Update .gitignore.

## [0.7.0](https://github.com/timirey/xapi-php/commits/0.7.0) - 2024-06-28

-Add default client.
-Add commands: login, logout, pint, tradeTransaction, tradeTransactionStatus, getAllSymbols, getSymbol.
-Add pest tests.
-Add php linter.
