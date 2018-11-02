<?php

use PHPUnit\Framework\TestCase;

// extend using TestCase instead PHPUnit_Framework_TestCase
class ConfigRepositoryTest extends TestCase {

    public function test_has_returns_true_if_a_config_item_is_set()
    {
        
        $config = new \App\Models\ConfigRepository(['paths' => ['base' => 'path', 'app' => 'path']]);


        $this->assertTrue($config->has('paths'));
    }

    public function test_has_returns_false_if_a_config_item_is_not_set()
    {
        $config = new \App\Models\ConfigRepository(['paths' => ['base' => 'path', 'app' => 'path']]);

        $this->assertFalse($config->has('foo'));
    }

    public function test_setting_config_items()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);

        $config->set('paths', ['base' => 'path', 'app' => 'path']);
        $config->set('options', ['foo' => 'bar']);

        $this->assertTrue($config->has('paths'));
        $this->assertTrue($config->has('options'));
    }

    public function test_get_an_item_from_the_config_array()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);

        $config->set('paths', ['base' => 'path', 'app' => 'path']);
        $config->set('options', 'value');

        $paths   = $config->get('paths');

        $this->assertEquals('value', $config->get('options'));
        $this->assertEquals(['base' => 'path', 'app' => 'path'], $paths);
        $this->assertEquals('path', $paths['base']);
    }


    public function test_getting_a_non_existing_key_returns_the_default_value()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);

    
        $this->assertNotEquals('foo', $config->get('key', 'foo'));
    }

    public function test_removing_an_item_from_the_config_array()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository(['foo' => 'bar', 'baz' => 'bam']);

        $config->remove('foo');
        $config->remove('bar');

        $this->assertFalse($config->has('foo'));
        $this->assertFalse($config->has('bar'));
    }

    public function test_loading_config_items_from_a_single_file()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);
        $config->load(__DIR__.'../../files/app.php');

        $checkPath = [
                'base_path'   => 'base/path',
                'app_path'    => 'app/path',
                'public_path' => 'public/path'
                    ];
        $config->set('base_path', $checkPath);

        $this->assertTrue($config->has('base_path'));
        $this->assertEquals(
            ['base_path' => 'base/path', 'app_path' => 'app/path', 'public_path' => 'public/path'],
            $config->get('base_path')
        );
    }

    public function test_loading_an_array_of_config_files()
    {
        $files = __DIR__.'../../files/database.php';
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);
        $config->load($files);

        $this->assertTrue($config->has('default'));
        $this->assertTrue($config->has('connections'));
    }

    public function test_array_access_set()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository($arrayName);

        $config=['foo' => 'bar'];
        $this->assertTrue(isset($config['foo']));
        $this->assertEquals('bar', $config['foo']);
    }

    public function test_array_access_unset()
    {
        $arrayName = array();
        $config = new \App\Models\ConfigRepository(['foo' => 'bar']);
        $config->remove('foo');

        $this->assertFalse($config->has('foo'));
    }
}