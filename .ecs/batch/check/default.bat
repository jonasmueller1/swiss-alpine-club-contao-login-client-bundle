:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
:: src
vendor\bin\ecs check vendor/markocupic/swiss-alpine-club-contao-login-client-bundle/src --config vendor/markocupic/swiss-alpine-club-contao-login-client-bundle/.ecs/config/default.php
:: tests
vendor\bin\ecs check vendor/markocupic/swiss-alpine-club-contao-login-client-bundle/tests --config vendor/markocupic/swiss-alpine-club-contao-login-client-bundle/.ecs/config/default.php
::
cd vendor/markocupic/swiss-alpine-club-contao-login-client-bundle/.ecs./batch/check
