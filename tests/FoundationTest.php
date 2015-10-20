<?php namespace Test;

use Illuminate\Pagination\LengthAwarePaginator;
use SSD\Pagination\Foundation;

class FoundationTest extends BaseCase
{

    /**
     *
     * Checks for empty result with empty collection.
     *
     * @test
     *
     */
    public function foundation_returns_null_with_empty_collection()
    {
        $collection = new LengthAwarePaginator(
            $this->empty_collection,
            count($this->empty_collection),
            1,
            30
        );
        $foundation = new Foundation($collection);

        $this->assertEmpty(
            $foundation->render(),
            'Pagination does not assert as empty'
        );
    }

    /**
     *
     * Check for empty result with 1 page.
     *
     * @test
     */
    public function foundation_returns_null_with_one_page()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            count($this->collection),
            1
        );
        $foundation = new Foundation($collection);

        $this->assertEmpty(
            $foundation->render(),
            'Pagination is not empty with one page'
        );
    }

    /**
     *
     * Check for two pages.
     *
     * @test
     */
    public function foundation_returns_pagination_with_two_pages()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            count($this->collection) / 2,
            1
        );
        $foundation = new Foundation($collection);

        $this->assertEquals(
            $this->fixture('foundation-two-pages.php'),
            $foundation->render(),
            'Pagination does not return two pages'
        );
    }

    /**
     *
     * Check for two pages.
     *
     * @test
     */
    public function foundation_returns_pagination_with_three_pages()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            ceil(count($this->collection) / 3),
            1
        );
        $foundation = new Foundation($collection);

        $this->assertEquals(
            $this->fixture('foundation-three-pages.php'),
            $foundation->render(),
            'Pagination does not return three pages'
        );
    }

    /**
     *
     * Check for 40 pages.
     *
     * @test
     */
    public function foundation_returns_pagination_with_40_pages()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            1,
            1
        );
        $foundation = new Foundation($collection);

        $this->assertEquals(
            $this->fixture('foundation-forty-pages.php'),
            $foundation->render(),
            'Pagination does not return forty pages'
        );
    }


}