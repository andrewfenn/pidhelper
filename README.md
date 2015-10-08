# PID Helper

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

[![Total Downloads](https://img.shields.io/packagist/dd/andrewfenn/pid-helper.svg?style=flat-square)](https://packagist.org/packages/andrewfenn/pid-helper)
[![Total Downloads](https://img.shields.io/packagist/dm/andrewfenn/pid-helper.svg?style=flat-square)](https://packagist.org/packages/andrewfenn/pid-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/andrewfenn/pid-helper.svg?style=flat-square)](https://packagist.org/packages/andrewfenn/pid-helper)

Just a small helper class designed to allow you to easily keep
track of code that is already running so that it doesn't run
twice.

### Why yet another PID helper class?

I wanted a process checker that did things properly on linux. It uses
the /proc interface to see if the process is still running. On OSX it
uses the ps command.

There is no windows support in this library. If you'd like to add it then
please submit a pull request that does something similar to the OSX or Linux
implementations.

### How to install

Add the following to your composer.json file and run ```composer update```.

```json
    "require": {
        "andrewfenn/pid-helper": "0.1.0"
    }
```

### How to use

To use it call the code as shown below. This class will check that the
process id is still running or not.

```php
<?php
use PidHelper/PidHelper;

$pidHelper = new PidHelper('/path/to/dir/', 'process.pid');

if (!$pidHelper->lock()) {
    exit("Script Running\n");
}

// .... Your code ....

// Optional
$pidHelper->unlock();
```
