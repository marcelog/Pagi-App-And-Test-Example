#!/bin/bash

# Get our base directory (the one where this script is located)
me=$(dirname ${0})
root=$(readlink -f ${me}/../..)

# Try to include the well known config file.
configFile=${root}/config/cli.properties

if [ ! -f ${configFile} ]; then
    echo Missing $configFile
    exit 254
fi

. ${root}/config/cli.properties

# Create the vendors directory if it does not exist.
if [ ! -d "${vendors}" ]; then
    echo Creating ${vendors}
    mkdir -p ${vendors}
fi

cd $vendors

# This will use the existing system pear installation to install
# a fresh copy in the vendors directory, setting up a pear
# configuration file with the needed options to make this new
# pear installation completely standalone.
function setupPear() {
    ${pear} config-create ${vendors} .pearrc
    ${pear} -c ${vendors}/.pearrc config-set php_dir ${vendors}/php
    ${pear} -c ${vendors}/.pearrc config-set bin_dir ${vendors}/bin
    ${pear} -c ${vendors}/.pearrc config-set cache_dir ${vendors}/pear/cache
    ${pear} -c ${vendors}/.pearrc config-set cfg_dir ${vendors}/pear/cfg
    ${pear} -c ${vendors}/.pearrc config-set data_dir ${vendors}/pear/data
    ${pear} -c ${vendors}/.pearrc config-set download_dir ${vendors}/pear/download
    ${pear} -c ${vendors}/.pearrc config-set temp_dir ${vendors}/pear/tmp
    ${pear} -c ${vendors}/.pearrc config-set auto_discover 1
    ${pear} -c ${vendors}/.pearrc install pear 
}

# This will use the new pear installation to install
# the application dependencies.
function pearInstall() {
    ${mypear} -c ${mypearrc} install --alldeps ${1}
}

# Install pear first, then all of the app dependencies
setupPear
oldIFS=${IFS}
IFS=$'\n'
for i in `cat ${config}/setup/dependencies`; do
    pearInstall ${i}
done
IFS=${oldIFS}

