<?php namespace Test;

use \PHPUnit_Framework_TestCase;

abstract class BaseCase extends PHPUnit_Framework_TestCase
{

    /**
     * Collection of pages.
     *
     * @var array
     */
    protected $collection = [];

    /**
     * Empty collection.
     *
     * @var array
     */
    protected $empty_collection = [];

    /**
     * Path to the fixtures directory.
     *
     * @var string
     */
    protected $fixtures = __DIR__ . '/fixtures/';

    /**
     * Setup the test environment by filling in
     * the $collection array with items.
     *
     * @return void
     */
    protected function setUp()
    {
        for($i = 1; $i <= 40; $i++) {
            $this->collection[$i] = 'page-' . $i;
        }
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->collection = [];
    }

    /**
     * Get content of the fixture file.
     *
     * @param $file_name
     * @return string
     */
    public function fixture($file_name)
    {
        $content = file_get_contents($this->fixtures . $file_name);

        return $this->trim($content);
    }

    /**
     * Trim the content.
     *
     * @param $content
     * @return string
     */
    public function trim($content)
    {
        return trim(preg_replace('/\s+/', ' ', $content));
    }

}