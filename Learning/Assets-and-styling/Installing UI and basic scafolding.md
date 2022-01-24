# Installing UI
`composer require laravel/ui 3.*`

# Using UI's preset
`php artisan ui bootstrap`

# To generate auth controllers
`php artisan ui:controllers`

# NPM run dev errors
```txt
[webpack-cli] Invalid configuration object. Webpack has been initialized using a configuration object that does not match the API schema.
 - configuration.module.rules[10] has an unknown property 'loaders'. These properties are valid:
   object { assert?, compiler?, dependency?, descriptionData?, enforce?, exclude?, generator?, include?, issuer?, issuerLayer?, layer?, loader?, mimetype?, oneOf?, options?, parser?, realResource?, resolve?, resource?, resourceFragm
ent?, resourceQuery?, rules?, scheme?, sideEffects?, test?, type?, use? }
   -> A rule description with conditions and effects for modules.
```

Fixed with:
```text
npm install laravel-mix@next
```
At package.json
```json
"devDependencies": {
    ...
    "laravel-mix": "^6.0.0-beta.17",
    ...  
}
```
