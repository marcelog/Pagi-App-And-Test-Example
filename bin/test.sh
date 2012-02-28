#!/bin/bash
me=$(dirname ${0})
root=$(readlink -f ${me}/..)
. ${root}/config/cli.properties

( \
 cd ${root}/test && \
 ${phpexec} ${vendors}/bin/phpunit \
   ${phpargs} --configuration phpunit.xml --verbose --colors \
   --bootstrap ../bin/bootstrap.php \
   --coverage-html ${root}/runtime/coverage && \
 cd - \
)


