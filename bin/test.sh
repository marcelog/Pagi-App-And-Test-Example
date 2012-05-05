#!/bin/sh

# Get our base directory (the one where this script is located)
# http://mywiki.wooledge.org/BashFAQ/028
me=$([[ $0 == /* ]] && echo "$0" || echo "${PWD}/${0#./}")
root=$(dirname ${me})/..

. ${root}/config/cli.properties

( \
 cd ${root}/test && \
 ${phpexec} ${vendors}/bin/phpunit \
   ${phpargs} --configuration phpunit.xml --verbose --colors \
   --bootstrap ../bin/bootstrap.php \
   --coverage-html ${root}/runtime/coverage && \
 cd - \
)


