#!/bin/sh

# Get our base directory (the one where this script is located)
me=$(dirname ${0})
root=${me}/..
root=`cd ${root}; pwd`

. ${root}/config/cli.properties

${phpexec} ${vendors}/bin/phpunit ${phpargs} -v --debug -c test/resources/phpunit.xml
