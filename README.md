Joseki/WebloaderFilters
=======================

Adapting javascript and CSS minify tools to [Webloader](https://github.com/janmarek/WebLoader).

Installation
------------

The best way to install is using  [Composer](http://getcomposer.org/):

```sh
$ composer require joseki/webloader-filters
```

Usage
-----

Register minify services to your `config.neon`:

```yml
services:
  cssMin: Joseki\Webloader\CssMinFilter
  jsMin: Joseki\Webloader\JsMinFilter
```

... and then you can use them inside WebLoader extension as follows:

```yml
webloader:
  css:
    default: # your WebLoader css control name
      filters:
        - @cssMin
```

or for javascript:

```yml
webloader:
  js:
    default: # your WebLoader js control name
      filters:
        - @jsMin
```

NOTE: when using as a `fileFilters`, files containing `.min.` in their names will be ignored

```yml
webloader:
  js:
    default: # your WebLoader js control name
      files:
        - script.js
        - script.min.js    # this file will not be filtered by @jsMin
      fileFilters:
        - @jsMin
```
