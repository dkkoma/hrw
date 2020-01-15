![](https://github.com/dkkoma/hrw/workflows/Test/badge.svg)
=======
# HRW

This is Rendezvous(highest random weight) hashing library. It requires PHP7+.

## Installation

```shell script
composer require dkkoma/hrw
```

## Usage

```php
$nodes = ['node-1', 'node-2', 'node-3'];
$hrw = new Hrw\Hrw($nodes);

$key = 'test-key';

$node = $hrw->pick($key); // node-2
```

## FYI

https://en.wikipedia.org/wiki/Rendezvous_hashing
