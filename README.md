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

### Credits
* [Lorzenzh with fut api](https://github.com/lorenzh/fut-api/)
* [Trydis with FIFA Ultimate Team Toolkit](https://github.com/trydis/FIFA-Ultimate-Team-Toolkit)