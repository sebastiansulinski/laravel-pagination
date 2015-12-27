<?php namespace SSD\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\UrlWindowPresenterTrait;

abstract class Pagination implements Presenter
{
    use UrlWindowPresenterTrait;

    /**
     * The paginator implementation.
     *
     * @var \Illuminate\Contracts\Pagination\Paginator
     */
    protected $paginator;

    /**
     * The URL window data structure.
     *
     * @var array
     */
    protected $window;

    /**
     * Pagination wrapper.
     *
     * @var string
     */
    protected $wrapper = '<ul class="pagination">%s%s%s</ul>';

    /**
     * Available link partial.
     *
     * @var string
     */
    protected $availablePageWrapper = '<li><a href="%s">%s</a></li>';

    /**
     * Available prev / next link partial.
     *
     * @var string
     */
    protected $availablePrevNextPageWrapper = '<li><a href="%s" rel="%s">%s</a></li>';

    /**
     * Active link partial.
     *
     * @var string
     */
    protected $activePageWrapper = '<li class="active"><span>%s</span></li>';

    /**
     * Disabled link partial.
     *
     * @var string
     */
    protected $disabledPageWrapper = '<li class="disabled"><span>%s</span></li>';

    /**
     * Previous link text.
     *
     * @var string
     */
    protected $previousButtonText = '&laquo;';

    /**
     * Next link text.
     *
     * @var string
     */
    protected $nextButtonText = '&raquo;';

    /***
     * "Dots" text.
     *
     * @var string
     */
    protected $dotsText = '...';

    /**
     * Create a new Pagination presenter instance.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator $paginator
     * @param  \SSD\Pagination\ExtendedUrlWindow $window
     */
    public function __construct(
        Paginator $paginator,
        ExtendedUrlWindow $window = null
    )
    {
        $this->paginator = $paginator;

        $this->window = is_null($window) ?
            ExtendedUrlWindow::make($paginator) :
            $window->get();
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages();
    }

    /**
     * Render the given paginator.
     *
     * @return string|null
     */
    public function render()
    {
        if ( ! $this->hasPages()) {
            return null;
        }

        return sprintf(
            $this->wrapper,
            $this->getPreviousButton(),
            $this->getLinks(),
            $this->getNextButton()
        );
    }

    /**
     * Get html tag for an available link.
     *
     * @param  string $url
     * @param  int $page
     * @param  null|string $rel
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        return sprintf($this->availablePageWrapper, $url, $page);
    }

    /**
     * Get html tag for an available prev/next link.
     *
     * @param  string $url
     * @param  int $page
     * @param  null|string $rel
     * @return string
     */
    protected function getAvailablePrevNextPageWrapper($url, $page, $rel = null)
    {
        return sprintf($this->availablePrevNextPageWrapper, $url, $rel, $page);
    }

    /**
     * Get html tag for an active text.
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return sprintf($this->activePageWrapper, $text);
    }

    /**
     * Get html tag for a disabled text.
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledLink($text)
    {
        return sprintf($this->disabledPageWrapper, $text);
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledLink($this->dotsText);
    }

    /**
     * Get the current page from the paginator.
     *
     * @return int
     */
    protected function currentPage()
    {
        return $this->paginator->currentPage();
    }

    /**
     * Get the last page from the paginator.
     *
     * @return int
     */
    protected function lastPage()
    {
        return $this->paginator->lastPage();
    }

    /**
     * Get html tag the previous page link.
     *
     * @return string
     */
    protected function getPreviousButton()
    {
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledLink($this->previousButtonText);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPrevNextPageLinkWrapper($url, $this->previousButtonText, 'prev');
    }

    /**
     * Get html tag for the next page link.
     *
     * @return string
     */
    protected function getNextButton()
    {
        if ( ! $this->paginator->hasMorePages()) {
            return $this->getDisabledLink($this->nextButtonText);
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPrevNextPageLinkWrapper($url, $this->nextButtonText, 'next');
    }

    /**
     * Get HTML wrapper for a prev/next page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getPrevNextPageLinkWrapper($url, $page, $rel = null)
    {
        if ($page == $this->paginator->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePrevNextPageWrapper($url, $page, $rel);
    }
}
