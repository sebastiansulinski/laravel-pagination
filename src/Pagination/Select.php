<?php namespace SSD\Pagination;


class Select extends Pagination
{
    /**
     * Pagination wrapper.
     *
     * @var string
     */
    protected $wrapper = '<form class="select-pagination">%s%s%s%s%s</form>';

    /**
     * Available prev / next link partial.
     *
     * @var string
     */
    protected $availablePrevNextPageWrapper = '<a href="%s" rel="%s">%s</a>';

    /**
     * Disabled link partial.
     *
     * @var string
     */
    protected $disabledPageWrapper = '<span class="disabled">%s</span>';

    /**
     * Page .. label.
     *
     * @var string
     */
    protected $pageLabel = '<span class="pagination-page">Page</span>';

    /**
     * .. 'of n' label.
     *
     * @var string
     */
    protected $pageOfLabel = '<span class="pagination-of">of %s</span>';

    /**
     * Available option partial.
     *
     * @var string
     */
    protected $availableOptionWrapper = '<option value="%s">%s</option>';

    /**
     * Active option partial.
     *
     * @var string
     */
    protected $activeOptionWrapper = '<option selected>%s</option>';

    /**
     * Previous button text.
     *
     * @var string
     */
    protected $previousButtonText = '&laquo;';

    /**
     * Next button text.
     *
     * @var string
     */
    protected $nextButtonText = '&raquo;';


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
            $this->pageLabel,
            $this->getSelect(),
            $this->getPageOfLabel(),
            $this->getNextButton()
        );
    }

    /**
     * Get 'of n' label.
     *
     * @return string
     */
    private function getPageOfLabel()
    {
        return sprintf($this->pageOfLabel, $this->paginator->lastPage());
    }

    /**
     * Get the select tag with options for the URLs in the given array.
     *
     * @return string
     */
    protected function getSelect()
    {
        $html = '<select>';

        if (is_array($this->window['all'])) {
            $html .= $this->getOptionLinks($this->window['all']);
        }

        $html .= '</select>';

        return $html;
    }

    /**
     * Get option tags with links for the URLs in the given array.
     *
     * @param  array $urls
     * @return string
     */
    protected function getOptionLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getOption($url, $page);
        }

        return $html;
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
        return sprintf($this->activeOptionWrapper, $text);
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
        return sprintf($this->availableOptionWrapper, $url, $page);
    }
}