# FormAPI

Simple API for creating forms for MCPE clients (PocketMine only)

> **Note:** This is a modified, stand-alone plugin version of FormAPI, stripped of virion support and refactored for modern PocketMine-MP standards.

## Key Changes in This Fork

* **PSR-12 Compliant:** Codebase fully formatted according to PSR-12 coding style guidelines.
* **Namespace Cleaned:** Standardized to `FormAPI\` (removed vendor/virion prefixes).
* **Removed `Form::sendToPlayer()`:** Use `$player->sendForm($form)` directly, as recommended by modern PocketMine-MP API.
* **Code Refactoring:** Method order inside classes has been logically reorganized for better readability.

## Including in other plugins

### As a plugin
This library can be loaded as a plugin phar. You can use the [`depend`](https://doc.pmmp.io/en/rtfd/developer-reference/plugin-manifest.html#depend) key in `plugin.yml` to require its presence.
