# About

An example PAGI IVR application (for asterisk and php, of course),
including unit tests with phpunit. This is the source code for
the article at:
[http://marcelog.github.com/articles/pagi_mock_client_unit_test_ivr_application_telephony_asterisk_agi.html](http://marcelog.github.com/articles/pagi_mock_client_unit_test_ivr_application_telephony_asterisk_agi.html)

# The code

* src/MyApp/App.php is the IVR application itself.
* test/AppTest.php is a phpunit test case for the ivr application. It
contains 2 unit tests.

The other files serve as a skeleton for running everything.

# Config

1. Copy the directory "config.example" (and its contents) to "config".
2. Edit config/php.ini if you need to change xdebug extension
path.
3. Edit config/cli.properties. Change "php" and "pear" to match the
paths in your filesystem (usually /usr/bin/php and /usr/bin/pear).
4. Run `./composer.phar install`

# Run the tests

```
$ bin/test.sh
```

The coverage will be generated as html in runtime/coverage.
You can find resulting logs from tests in runtime/log/dev.log

Run the IVR
-----------
In your extensions.conf, put these lines (modify to suit your paths):
exten => 123,1,AGI(/home/ivr/bin/runIvr.sh)
exten => 123,n,Hangup

Run the application by calling 123 (or the extension you've configured).
Resulting logs are in runtime/log/production.log



