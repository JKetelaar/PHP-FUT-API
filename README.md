[![Build Status](https://travis-ci.org/JKetelaar/PHP-FUT-API.svg?branch=master)](https://travis-ci.org/JKetelaar/PHP-FUT-API)

# The perfect PHP FUT Bot
This is a perfect FUT Bo...   
No wait, let's first answer a question

**Are you an EA employee?**  
**Y:** This is nothing, just leave...  
**N:** Great! Welcome to the perfect PHP FUT Bot :smirk:

## How to install?
Well you need Node first, [install that](https://nodejs.org/en/download/)!

Now download this project and start using:
```
require_once('vendor/autoload.php');

define('NODE_LOCATION', '/usr/local/bin/node');
define('DATA_DIR', __DIR__ . '/data/');

$api = new \JKetelaar\fut\bot\API('your@email.me', 'password', 'secret', 'totp_callback', 'platform');

if ($api->login()){
    echo('Correct login!');
}

function totp_callback() {
    $totp = new \OTPHP\TOTP('FIFA', 'SECRET');

    return $totp->now();
}
```

## FAQ
#### How do the enum(eration)s work?
As you might have seen, we're using an implemententation of php-enum, so we could provide enumerations within classes and type hinting.  
An example of this is the class `ChemistryStyle`.

With a few constants, you can access the variables, but also use them for type hinting.  
Let's say you have:
```
class ChemistryStyle extends Enum  {
    const BASIC = 250;
    const SNIPER = 251;
}
```
Now we can get the values of the constants, by doing: `ChemistryStyle::BASIC`.

But in a more advanced level, we can also use these for type hinting, using parenthesises.  
Say we have the function:
```
function findByChemistryStyle(ChemistryStyle $style){
    echo('Searching for players with style ID' . $style);
}
```
As you can see, we have a parameter, which only allows ChemistryStyle.  
We can call this function using the constant and adding an opening-and-closing parenthesis:
```
findByChemistryStyle(ChemistryStyle::SNIPER())
```

### Credits
* [Lorzenzh with fut api](https://github.com/lorenzh/fut-api/)
* [Trydis with FIFA Ultimate Team Toolkit](https://github.com/trydis/FIFA-Ultimate-Team-Toolkit)

### ToDo's
We currently have a few things to be done, so feel free to contribute;
* Fix the [Hasher](https://github.com/JKetelaar/PHP-FUT-Bot/blob/master/src/JKetelaar/fut/bot/user/Hasher.php)
* Create a proper Composer project from this (so `composer require jketelaar/php-fut-bot` can be used)