var hasher = require("./hasher");

var secret = '';
process.argv.forEach(function (val, index) {
    if (index >= 2) {
        secret += val;
    }
});

console.log(hasher(secret));