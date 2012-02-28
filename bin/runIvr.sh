#!/bin/sh

me=$(dirname ${0})
root=$(readlink -f ${me}/..)
. ${root}/config/cli.properties

${bin}/run.sh ivr
