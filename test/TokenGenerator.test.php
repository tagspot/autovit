<?php

namespace tagspot\autovit;

use PHPUnit\Framework\TestCase;
use tagspot\autovit\Exceptions\TokenGeneratorException;
use tagspot\autovit\Handlers\TokenGenerator;

class TokenGeneratorTest extends TestCase {

    public function test_it_throws_token_generator_exception() {
        try {
            TokenGenerator::generate([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
                'url' => 'url',
                'production' => 'false',
            ]);
        } catch (TokenGeneratorException $ex) {
            $this->assertContains("Error:", $ex->getMessage());
            return;
        }
        $this->fail("Expected Exception of type 'TokenGeneratorException' with error message has not been raised.");
    }

}