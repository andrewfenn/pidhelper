# PID Helper

Just a small helper class designed to allow you to easily keep
track of code that is already running so that it doesn't run
twice.

### How to install

Add the following to your composer.json file and run ```composer update```.

```json
    "require": {
        "andrewfenn/pid-helper": "dev-master"
    },
    "repositories": [{
        "type": "vcs",
        "url":  "https://github.com/andrewfenn/pidhelper.git"
    }],
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
