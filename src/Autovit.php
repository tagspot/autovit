<?php

namespace tagspot\autovit;

use tagspot\autovit\Exceptions\BadConfigException;
use tagspot\autovit\Handlers\TokenGenerator;

class Autovit {

    protected $config;

    function __construct(array $config = [])
    {
        if (isset($config['client_id'])) {
            $this->config['client_id'] = $config['client_id'];
        } else {
            throw new BadConfigException('Client id is missing!');
        }

        if (isset($config['client_secret'])) {
            $this->config['client_secret'] = $config['client_secret'];
        } else {
            throw new BadConfigException('Client secret is missing!');
        }

        if (isset($config['username'])) {
            $this->config['username'] = $config['username'];
        } else {
            throw new BadConfigException('Username is missing!');
        }

        if (isset($config['password'])) {
            $this->config['password'] = $config['password'];
        } else {
            throw new BadConfigException('Password is missing!');
        }

        $this->config['production'] = !isset($config['production']) ? false : (is_bool($config['production']) ? $config['production'] : false);

        $this->config['url'] = $this->url();
    }

    protected function url() {
        return $this->config['production'] == true ? Config::production_url : Config::sandbox_url;
    }

    protected function generateToken() {
        $this->config['token'] = TokenGenerator::generate($this->config);
    }

}