<?php
namespace tagspot\autovit;

use PHPUnit\Framework\TestCase;
use tagspot\autovit\Exceptions\BadConfigException;
use tagspot\autovit\Utils\PHPUnitUtil;

class AutovitTest extends TestCase {

    public function test_it_throws_an_exception_if_client_id_is_missing_from_config_array_in_constructor() {
        try {
            new Autovit();
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Client id is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Client id is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_client_secret_is_missing_from_config_array_in_constructor() {
        try {
            new Autovit([
                'client_id' => 'client_id'
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Client secret is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Client secret is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_username_is_missing_from_config_array_in_constructor() {
        try {
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Username is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Username is missing!' has not been raised.");
    }

    public function test_it_throws_an_exception_if_password_is_missing_from_config_array_in_constructor() {
        try {
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username'
            ]);
        } catch (BadConfigException $ex) {
            $this->assertEquals($ex->getMessage(), "Password is missing!");
            return;
        }
        $this->fail("Expected Exception of type 'BadConfigException' with message 'Password is missing!' has not been raised.");
    }

    public function test_it_selects_sandbox_url_when_production_flag_is_missing_from_config_array_in_constructor() {
        $url = PHPUnitUtil::callMethod(
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password'
            ]),
            'url'
        );

        $this->assertEquals(Config::sandbox_url, $url);
    }

    public function test_it_selects_sandbox_url_when_non_boolean_production_flag_is_passed_in_the_config_array_in_constructor() {
        $url = PHPUnitUtil::callMethod(
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
                'production' => 'asdad..dsd'
            ]),
            'url'
        );

        $this->assertEquals(Config::sandbox_url, $url);
    }

    public function test_it_selects_sandbox_url_when_production_flag_false_is_passed_in_the_config_array_in_constructor() {
        $url = PHPUnitUtil::callMethod(
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
                'production' => false
            ]),
            'url'
        );

        $this->assertEquals(Config::sandbox_url, $url);
    }

    public function test_it_selects_production_url_when_production_flag_true_is_passed_in_the_config_array_in_constructor() {
        $url = PHPUnitUtil::callMethod(
            new Autovit([
                'client_id' => 'client_id',
                'client_secret' => 'client_secret',
                'username' => 'username',
                'password' => 'password',
                'production' => true
            ]),
            'url'
        );

        $this->assertEquals(Config::production_url, $url);
    }

}