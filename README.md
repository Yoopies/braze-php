This is a non-official Braze PHP library which provides access to the Braze API from applications written in the PHP language.

Api references: https://www.braze.com/docs/api/

## Installation

The recommended way to install braze-php is through [Composer](https://getcomposer.org):


```
composer require yoopies/braze-php
```

## Usage

```php
use Braze\BrazeClient;

$client = new BrazeClient('apiKey', 'rest.fra-01.braze.eu');

$client->user->track(
    [
        'events' => [
            [
                '_update_existing_only' => false,
                'name'                  => 'my_event_name',
                'external_id'           => '1234',
                'time'                  => (new \DateTime())->format('c'),
            ],
        ],
    ]
);
```
