# Seeder

`php artisan db:seed` to seed DB

## Create seeder

`php artisan make:seeder [SEEDER_NAME]`

## Troubleshooting

- if something fails during seeding, first, try to run `composer dump-autoload`


## Calling seeders individually

`php artisan db:seed --class=[SEEDER_FILE_NAME]`
