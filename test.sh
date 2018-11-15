#!/usr/bin/env bash

(cd tests/Application && yarn install)
(cd tests/Application && yarn build)
(cd tests/Application && bin/console assets:install public -e test)

(cd tests/Application && bin/console doctrine:database:create -e test)
(cd tests/Application && bin/console doctrine:schema:create -e test)
