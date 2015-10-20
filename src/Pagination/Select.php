<?php namespace SSD\Pagination;


class Select extends Pagination
{
    /**
     * Pagination wrapper.
     *
     * @var string
     */
    protected $wrapper = '<form class="pagination-wrapper">%s%s%s%s%s</form>';

    /**
     * Available link partial.
     *
     * @var string
     */
    protected $availableLinkPartial = '<a href="%s">%s</a>';

    /**
     * Active link partial.
     *
     * @var string
     */
    protected $activeLinkPartial = '<span class="active">%s</span>';

    /**
     * Disabled link partial.
     *
     * @var string
     */
    protected $disabledLinkPartial = '<span class="disabled">%s</span>';


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
            $this->getPageLabel(),
            $this->getSelect(),
            $this->getPageOfLabel(),
            $this->getNextButton()
        );
    }

    /**
     * Get 'Page' label.
     *
     * @return string
     */
    private function getPageLabel()
    {
        return '<span class="pagination-page">Page</span>';
    }

    /**
     * Get 'of n' label.
     *
     * @return string
     */
    private function getPageOfLabel()
    {
        return '<span class="pagination-of">of '.$this->paginator->lastPage().'</span>';
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
            $html .= $this->getUrlLinks($this->window['all']);
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
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getOption($url, $page);
        }

        return $html;
    }

}