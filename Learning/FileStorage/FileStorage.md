# File storage

## Facade

## Disks

Second layer of storage configuaration
Provides an option, that framework can use to store data by wrapping all information together
Provides certain settings, e.g. `root, url, visibility, secret, region ...`
But mainly `driver`

e.g.:
- local
- public
- s3

### ENV

- FILESYSTEM_DRIVER

## Driver

Defines, how the data get on the actual physical disk.

e.g.:
- local
- public
- s3
- ftp

## Storage functinos

- to fetch path: `storage_path()`


## Uploading a file

- if handled within blade form, `enctype="multipart/form-data"` necessary to use

### Backend

`$file->*` -> uses PUBLIC disk

- `$request->hasFile('name_of_input')`
- fetch file: `$file = $request->file('name_of_input')`
- `$path_to_file = $file->store('path to folder')` | `Storage::disk('public')->putFile('path to folder', $file)`
- store with name: `$file->storeAs('path to folder', 'name')` | `Storage::disk('public')->putFileAs('path to folder', $file, 'name')`


- get the file: `Storage::disk('public')->url('path')`

#### Validations

Most basic one: `image`
Also other: `mimes:jpeg,gif`, `max:1024` (kb), `dimensions:min_height=500,width=1000,ratio=16/9`