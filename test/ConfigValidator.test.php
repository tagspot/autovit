<?php

namespace tagspot\autovit;

use PHPUnit\Framework\TestCase;
use tagspot\autovit\Exceptions\BadConfigException;
use tagspot\autovit\Handlers\TokenGenerator;

class ConfigValidatorTest extends TestCase {

    public function test_it_throws_an_exception_if_client_id_is_missing() {
        try {
            new TokenGenerator([]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Client id is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Client id is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_client_secret_is_missing() {
        try {
            new TokenGenerator([
                'client_id' => 'client_id'
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Client secret is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Client secret is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_username_is_missing() {
        try {
            new TokenGenerator([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Username is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Username is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_password_is_missing() {
        try {
            new TokenGenerator([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Password is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Password is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_production_is_missing() {
        try {
            new TokenGenerator([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Production is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Production is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_url_is_missing() {
        try {
            new TokenGenerator([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
                'production' => 'production',
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Url is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Url is missing!' has not been raised.");
    }

}