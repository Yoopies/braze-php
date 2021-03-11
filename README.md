This is a non-official Braze PHP library which provides access to the Braze API from applications written in the PHP language.

Api references: https://www.braze.com/docs/api/

## API version
Last update: 1.11.2


## Installation

The recommended way to install braze-php is through [Composer](https://getcomposer.org):


```
composer require antoinelemaire/braze-php
```

## Usage
### Client

```php
use Braze\BrazeClient;

$client = new BrazeClient('apiKey', 'rest.fra-01.braze.eu');
```
