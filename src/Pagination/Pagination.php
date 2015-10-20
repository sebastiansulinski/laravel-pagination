<?php namespace SSD\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\UrlWindowPresenterTrait;

abstract class Pagination extends Partials implements Presenter
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
     * Create a new Pagination presenter instance.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator $paginator
     * @param  \SSD\Pagination\ExtendedUrlWindow $window
     * @return void
     */
    public function __construct(Paginator $paginator, ExtendedUrlWindow $window = null)
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
            $this->getWrapper(),
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
     * @return string
     */
    protected function getAvailableLink($url, $page)
    {
        return sprintf($this->getAvailableLinkPartial(), $url, $page);
    }

    /**
     * Get html tag for a disabled text.
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledLink($text)
    {
        return sprintf($this->getDisabledLinkPartial(), $text);
    }

    /**
     * Get html tag for an active text.
     *
     * @param  string $text
     * @return string
     */
    protected function getActiveLink($text)
    {
        return sprintf($this->getActiveLinkPartial(), $text);
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledLink($this->getDotsText());
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
     * Get html tag for a page link.
     *
     * @param  string $url
     * @param  int $page
     * @return string
     */
    protected function getPageLink($url, $page)
    {
        if ($page == $this->paginator->currentPage()) {
            return $this->getActiveLink($page);
        }

        return $this->getAvailableLink($url, $page);
    }

    /**
     * Get html tag the previous page link.
     *
     * @return string
     */
    protected function getPreviousButton()
    {
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledLink($this->getPreviousButtonText());
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLink($url, $this->getPreviousButtonText());
    }

    /**
     * Get html tag for the next page link.
     *
     * @return string
     */
    protected function getNextButton()
    {
        if ( ! $this->paginator->hasMorePages()) {
            return $this->getDisabledLink($this->getNextButtonText());
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLink($url, $this->getNextButtonText());
    }

    /**
     * Get html option tag.
     *
     * @param  string $url
     * @param  int $page
     * @return string
     */
    protected function getOption($url, $page)
    {
        if ($page == $this->paginator->currentPage()) {
            return $this->getActiveOption($page);
        }

        return $this->getAvailableOption($url, $page);
    }

    /**
     * Get active html option tag.
     *
     * @param $text
     * @return string
     */
    protected function getActiveOption($text)
    {
        return sprintf($this->getActiveOptionPartial(), $text);
    }

    /**
     * Get available html option tag.
     *
     * @param  string $url
     * @param  int $page
     * @return string
     */
    protected function getAvailableOption($url, $page)
    {
        return sprintf($this->getAvailableOptionPartial(), $url, $page);
    }

}
