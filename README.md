# PID Helper

Just a small helper class designed to allow you to easily keep
track of code that is already running so that it doesn't run
twice.

```
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
