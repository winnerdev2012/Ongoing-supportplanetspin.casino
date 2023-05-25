#!/bin/bash

mkdir -p roots/static/dist

if [ -d ../wlc-engine ]; then
    if [ -d ./node_modules/@egamings/wlc-engine ]; then
        rm -rf ./node_modules/@egamings/wlc-engine
    fi

    cd ./node_modules/@egamings
    ln -s ../../../wlc-engine wlc-engine
    cd ../..

    if [ -L ./wlc-engine ]; then
        rm ./wlc-engine
    fi

    ln -s ./node_modules/@egamings/wlc-engine/wlc-engine ./wlc-engine
fi

if [ -f roots/template/angular.html ] || [ -L roots/template/angular.html ]; then
    rm roots/template/angular.html
fi

ln -s ../static/dist/index.html roots/template/angular.html
