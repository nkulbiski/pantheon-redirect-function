# Pantheon Redirect Function
A function to add WordPress redirects to Pantheon.io, since they do not support .htaccess

## Placement
Place in wp-config.php. For details see [Pantheon.io docs for details](https://pantheon.io/docs/redirects/).

## Example
```php
k_redirect('/([0-9]+)/([0-9]+)/([0-9]+)/(.*)$', '/$4', true);
```
Will redirect /2018/10/08/post-title to /post-title.
