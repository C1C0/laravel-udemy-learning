# Emails

- mail driver
  - smtp, mailgun, etc ...


## Mailable

- `content()`
  - defines how email is build


- subject
- from
- etc ...

### Public propertier

- automatically accessible in templates

### Views
- good if within `emails`

### Attaching files

`->attach($pathtoFileUsingStoragePath), ->attachFromStorage($pathWithinStorage)` in `content()`

`->attachData` for attaching data from memory

### Display images

- `<img src="{{ $message->embed(FullURL) }}"/>` - embeds image and displays in img tag

### Markdown mailables

`php artisan vendor:publish --tag=laravel-mail` if you need to customize them

- `->markdown('...')`

```php
<x-mail::message>
# Order Shipped
 
Your order has been shipped!
 
<x-mail::button :url="$url">
View Order
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
```

- when mail sent, available as HTML same as TEXT

- style in `default.css` within `mail/html/themes`
  - or in config, you can select Theme file

## Sending

`Mail::to($email)->send(new MailableInstanceClass($parameters))`

## Previewing

```php
Route::get('any name', function(){
    return new App\Mail\Mailable();
})
```