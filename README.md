[![Build Status](https://travis-ci.org/crazycodr/previous-current-iterator.svg)](https://travis-ci.org/crazycodr/previous-current-iterator)

# Previous/Current iterator
Allows iteration over an array but returns two items at a time stepping by one item at a time. Thus, the iterator for

```PHP
['a', 'b', 'c', 'd']
```
    
Will return

```PHP
['previous' => 'a', 'current' => 'b']
['previous' => 'b', 'current' => 'c']
['previous' => 'c', 'current' => 'd']
```

# Installation

To install it, just include this requirement into your composer.json

```JSON
{
    "require": {
        "crazycodr/previous-current-iterator": "1.*"
    }
}
```
And then run composer install/update as necessary.

# Supports

Only PHP 5.5 or more can be supported due to the fact that key() can only return arrays starting with PHP 5.5!

# Examples

To use the PreviousCurrentIterator, just instanciate a copy with an array and foreach it!

```PHP
$data = ['a', 'b', 'c', 'd'];
foreach(new PreviousCurrentIterator($data) as $keys => $values) {
    //Compare previous and current
    if ($values['previous'] !== $values['current']) {
        echo 'Not the same<br />';
    }
}
```

# Use cases

Practical if you need to compare two items together in a previous vs current or current vs next manner.