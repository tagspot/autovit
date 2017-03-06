<?php

namespace tagspot\autovit\Utils;

use tagspot\autovit\Exceptions\BadConfigException;

class TokenGeneratorConfigValidator {

    public static function validate($config) {

        if (!isset($config['client_id'])) {
            throw new BadConfigException('Client id is missing!');
        }

        if (!isset($config['client_secret'])) {
            throw new BadConfigException('Client secret is missing!');
        }

        if (!isset($config['username'])) {
            throw new BadConfigException('Username is missing!');
        }

        if (!isset($config['password'])) {
            throw new BadConfigException('Password is missing!');
        }

        if (!isset($config['production'])) {
            throw new BadConfigException('Production is missing!');
        }

        if (!isset($config['url'])) {
            throw new BadConfigException('Url is missing!');
        }
    }

}