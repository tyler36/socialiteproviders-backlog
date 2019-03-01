# Backlog provider

A simple provider for use with Laraval/Socialite

## Installation

```shell
composer require tyler36/socialiteproviders-backlog
```

## Configuration

1. Visit [Backlog Developer](https://backlog.com/developer/applications/) page to get client secret and key
2. Complete the following in your ```.env``` file

    ```env
    BACKLOG_CLIENT_ID=
    BACKLOG_CLIENT_SECRET=
    BACKLOG_CALLBACK_URL=
    ```

3. Add your Backlog SPACE to your ```.env``` file.
This is the XXX (```https://XXX.backlog.jp/dashboard```) part of the URL you use to visit Backlog.

    ```env
    BACKLOG_SPACE=
    ```

4. Add the ENV variables to ```config/services.php```

    ```php
    'backlog' => [
        'client_id'     => env('BACKLOG_CLIENT_ID'),
        'client_secret' => env('BACKLOG_CLIENT_SECRET'),
        'redirect'      => env('BACKLOG_CALLBACK_URL'),
        'space'         => env('BACKLOG_SPACE'),
    ],
    ```
