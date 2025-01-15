#!/bin/bash

standard='--standard=./ruleset.xml'
path='./src ./tests'
extra='--cache -p -s --colors '

#extra+=' --report=diff -vvv' #uncomment for debug

if [ "$1" == "-full" ]; then
  php ./vendor/bin/phpcs $standard $path $extra
elif [ "$1" == '-fix' ]; then
  php ./vendor/bin/phpcbf $standard $path $extra
else
  php ./vendor/bin/phpcs --report=summary $standard $path $extra
fi