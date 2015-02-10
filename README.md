# PID Helper

Just a small helper class designed to allow you to easily keep
track of code that is already running so that it doesn't run
twice.

```
<?php
$pidHelper = new PIDHelper('/path/to/dir', 'process.pid');

if ($pidHelper->running()) {
    exit("Script Running\n");
}
$pidHelper->begin();

// .... Your code ....

// Optional
$pidHelper->end();
```
