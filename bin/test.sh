#!/bin/sh

# Get our base directory (the one where this script is located)
me=$(dirname ${0})
root=${me}/..
root=`cd ${root}; pwd`

. ${root}/config/cli.properties

( \
 cd ${root}/test && \
 ${phpexec} ${vendors}/bin/phpunit \
   ${phpargs} --configuration phpunit.xml --verbose --colors \
   --bootstrap ../bin/bootstrap.php \
   --coverage-html ${root}/runtime/coverage && \
 cd - \
)


