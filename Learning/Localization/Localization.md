# Localization

## Config (app.php)

- timezone
- locale
- fallback_locale
  - should be the MAIN main one, that your app will be always translated to

## Translations (PHP files)

- `resources/lang/{locale}`

### Different messages based on count

`return ['apples' => '{0} There are none|[1,19] There are some|[20,*] There are many',]`

## Translations (JSON)

- `resource/lang/{nameOfLang}.json`

```json
{
    "text to translate (used as key, most likely from fallback)" : "Translation"
}
```

- you may combine it with PHP files, where you store really long string in PHP file and short, which fit into view file, in json

## Usage

- `__({file}.{key}, {attributes})` function

### Display many options translations

`trans_choice($key, $number, $attributes)`

## Set app wide Locale

`App::setLocale($locale)`

## Session

- one option is to also store locale in the DB on user model and then fetch it and store it on session

## Setting prefixes

- using apache
  - if set somewhere in the middleware, that "locale" query is being set to the session ... 
  ```.htaccess
  RedirectMatch "^/(en|de|es)/?(.*)?" "/$2?locale=$1"
  ```
  `(en|de|es) = group 1 ($1)`


  `(.*) = group 2 ($2)`


- now you can use `/de/anything` = `anything?locale=de`