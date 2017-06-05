# Nested autowiring does not work

Nested autowire definitions do not seem to work.

The installed package versions can be found in the `composer.lock` file.


## Usage

``` bash
$ composer install
$ docker run --rm -it -v $PWD:/app -w /app php php run.php
```


## Results

Error message: `Entry "Father" cannot be resolved: Entry "" cannot be resolved: Parameter $toy of __construct() has no value defined or guessable`

Don't know whether it's desired or not.
