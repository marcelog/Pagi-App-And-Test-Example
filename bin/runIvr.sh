#!/bin/sh

# Get our base directory (the one where this script is located)
# http://mywiki.wooledge.org/BashFAQ/028
me=$([[ $0 == /* ]] && echo "$0" || echo "${PWD}/${0#./}")
root=$(dirname ${me})/..

. ${root}/config/cli.properties

${bin}/run.sh ivr
