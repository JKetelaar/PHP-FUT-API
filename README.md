# The perfect PHP FUT Bot
This is a perfect FUT Bo...   
No wait, let's first answer a question

**Are you an EA employee?**  
**Y:** This is nothing, just leave...  
**N:** Great! Welcome to the perfect PHP FUT Bot :smirk:

## How to install?
Well you need Node first, install that!

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
    $totp = new \OTPHP\TOTP('FIFA', 'KXVY7VWMX2IMLDIM');

    return $totp->now();
}
```