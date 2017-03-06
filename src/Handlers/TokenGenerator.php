<?php

namespace tagspot\autovit\Handlers;

use tagspot\autovit\Exceptions\TokenGeneratorException;
use tagspot\autovit\Utils\TokenGeneratorConfigValidator;

class TokenGenerator {

    protected $config;

    public function __construct(array $config)
    {
        TokenGeneratorConfigValidator::validate($config);

        $this->config = $config;
    }

    public static function generate(array $config) {
        return (new static($config))->handle();
    }

    protected function handle() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->config['url'] . '/oauth/token/ ');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . $this->config['username'] . "&password = " . $this->config['password'] . "&grant_type = password");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->config['client_id'] . ":" . $this->config['client_secret']);

        $headers = array();
        $headers[] = "Accept: application / json";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new TokenGeneratorException('Error:' . curl_error($ch));
        }
        curl_close ($ch);

        $result = json_decode($result);
        if (isset($result->error)) {
            throw new TokenGeneratorException('Error:' . $result->error_description);
        }

        return $result->access_token;
    }
}