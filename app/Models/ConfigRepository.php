<?php
namespace app\Models;

class ConfigRepository
{
     protected $config = array();
    /**
     * ConfigRepository Constructor
     */
    public function __construct(array $config = null)
    {
     
        $this->setArray($config);   
    }

    /**
     * Determine whether the config array contains the given key
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        if(array_key_exists($key,$this->config)){
          //echo "Key exists!";
            return true;
          }else{
          //echo "Key does not exist!";
            return false;
          } 
    }
    /**
    * excepts the path of the config file to load from
    * 
    * @param array $paths
    * 
    * @return void
    */
    public function setArray(array $paths)
    {
        $this->config = array_merge($this->config, $paths);
    }
    
    /**
    * returns the path array
    * 
    * @param void
    * 
    * @return array
    */
    public function getArray()
    {
        return $this->config;
    }  
    /**
     * Set a value on the config array
     *
     * @param string $key
     * @param mixed  $value
     * @return \Coalition\ConfigRepository
     */
    public function set($key, $path)
    {
        $this->config[$key] = $path;
    }

    /**
     * Get an item from the config array
     *
     * If the key does not exist the default
     * value should be returned
     *
     * @param string     $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->config[$key]) ? $this->config[$key] : false;
    }

    /**
     * Remove an item from the config array
     *
     * @param string $key
     * @return \Coalition\ConfigRepository
     */
    public function remove($key = null)
    {
        if(!is_null($key) && $this->get($key) != false)
        {
            unset($this->config[$key]);
            return true;
        }
        
        $this->config = array();
        return true;
    }

    /**
     * Load config items from a file or an array of files
     *
     * The file name should be the config key and the value
     * should be the return value from the file
     * 
     * @param array|string The full path to the files $files
     * @return void
     */
    public function load($files)
    {
        $paths = require $files;
        $this->setArray($paths);
    }
}