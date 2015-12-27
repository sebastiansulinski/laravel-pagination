<?php namespace Test;


use Illuminate\Pagination\LengthAwarePaginator;
use SSD\Pagination\Select;

class SelectTest extends BaseCase
{

    /**
     * Check for empty result with empty collection.
     *
     * @test
     */
    public function select_returns_null_with_empty_collection()
    {
        $collection = new LengthAwarePaginator(
            $this->empty_collection,
            count($this->empty_collection),
            1,
            1
        );
        $select = new Select($collection);

        $this->assertEmpty(
            $select->render(),
            'Pagination does not assert as empty'
        );
    }

    /**
     *
     * Check for empty result with 1 page.
     *
     * @test
     */
    public function select_returns_null_with_one_page()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            count($this->collection),
            1
        );
        $select = new Select($collection);

        $this->assertEmpty(
            $select->render(),
            'Pagination is not empty with one page'
        );
    }

    /**
     *
     * Check for two pages.
     *
     * @test
     */
    public function select_returns_pagination_with_two_pages()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            count($this->collection) / 2,
            1
        );
        $select = new Select($collection);

        $this->assertEquals(
            $this->fixture('select-two-pages.php'),
            $select->render(),
            'Pagination does not return two pages'
        );
    }

    /**
     *
     * Check for two pages.
     *
     * @test
     */
    public function select_returns_pagination_with_three_pages_active_page_2()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            ceil(count($this->collection) / 3),
            2
        );
        $select = new Select($collection);

        $this->assertEquals(
            $this->fixture('select-three-pages.php'),
            $select->render(),
            'Pagination does not return three pages'
        );
    }

    /**
     *
     * Check for forty pages.
     *
     * @test
     */
    public function select_returns_pagination_with_forty_pages()
    {
        $collection = new LengthAwarePaginator(
            $this->collection,
            count($this->collection),
            1,
            1
        );
        $select = new Select($collection);

        $this->assertEquals(
            $this->fixture('select-forty-pages.php'),
            $select->render(),
            'Pagination does not return forty pages'
        );
    }

}