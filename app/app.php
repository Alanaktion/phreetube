<?php
final class App
{
    static private $_config;
    static private $_router;
    static private $_db;

    /**
     * Initialize the app
     */
    static function init()
    {
        // Load configuration
        if(is_file('config.php')) {
            self::$_config = require('config.php');
        } else {
            throw new Exception('No config.php file found.');
        }

        // Initialize Composer autoloader
        require_once 'vendor/autoload.php';

        // Initialize framework
        self::$_router = Base::instance();
        self::$_router->mset([
            'AUTOLOAD' => 'app/',
            'ESCAPE' => false,
            'PACKAGE' => 'alanaktion/phreetube',
            'UI' => 'app/view/',
        ]);
        self::$_router->mset(self::$_config);

        // Initialize database connection and query builder
        self::$_db = new DB\SQL(
            'mysql:host='.self::$_config['db']['host'].';port=3306;dbname='.self::$_config['db']['database'],
            self::$_config['db']['username'],
            self::$_config['db']['password']
        );

        // Initialize routes
        require_once 'routes.php';
    }

    /**
     * Automatically load classes when required
     * @param string $class
     */
    static function autoload($class)
    {
        $filename = strtolower(str_replace('\\', '/', $class)) . '.php';
        if (is_file(__DIR__ . DIRECTORY_SEPARATOR . $filename)) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . $filename;
        }
    }

    /**
     * Get a router instance
     * @return Base
     */
    static function router()
    {
        return self::$_router;
    }

    /**
     * Run the routing engine
     */
    static function run()
    {
        self::$_router->run();
    }

    /**
     * Get app configuration
     * @return array
     */
    static function config()
    {
        return self::$_config;
    }

    /**
     * Trigger router error
     * @param int $code
     */
    static function error($code = null)
    {
        return self::$_router->error($code);
    }

    /**
     * Get a database instance
     * @return DB\SQL
     */
    static function db()
    {
        return self::$_db;
    }

    /**
     * Get a model instance
     * @param  string $name
     * @return Model
     */
    static function model($name, array $args = null)
    {
        $className = 'Model\\' . str_replace(array('/', '_'), '\\', ucwords($name));
        $class = new ReflectionClass($className);
        return $class->newInstanceArgs($args);
    }

}
