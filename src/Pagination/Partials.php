<?php namespace SSD\Pagination;

abstract class Partials
{

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
    protected $availableLinkPartial = '<li><a href="%s">%s</a></li>';

    /**
     * Active link partial.
     *
     * @var string
     */
    protected $activeLinkPartial = '<li class="active"><span>%s</span></li>';

    /**
     * Disabled link partial.
     *
     * @var string
     */
    protected $disabledLinkPartial = '<li class="disabled"><span>%s</span></li>';

    /**
     * Available option partial.
     *
     * @var string
     */
    protected $availableOptionPartial = '<option value="%s">%s</option>';

    /**
     * Active option partial.
     *
     * @var string
     */
    protected $activeOptionPartial = '<option selected>%s</option>';

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
     * Get pagination wrapper.
     *
     * @return string
     */
    final protected function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Get available link.
     *
     * @return string
     */
    final protected function getAvailableLinkPartial()
    {
        return $this->availableLinkPartial;
    }

    /**
     * Get active link.
     *
     * @return string
     */
    final protected function getActiveLinkPartial()
    {
        return $this->activeLinkPartial;
    }

    /**
     * Get disabled link.
     *
     * @return string
     */
    final protected function getDisabledLinkPartial()
    {
        return $this->disabledLinkPartial;
    }

    /**
     * Get available option.
     *
     * @return string
     */
    final protected function getAvailableOptionPartial()
    {
        return $this->availableOptionPartial;
    }

    /**
     * Get active option.
     *
     * @return string
     */
    final protected function getActiveOptionPartial()
    {
        return $this->activeOptionPartial;
    }

    /**
     * Get previous button text.
     *
     * @return string
     */
    final protected function getPreviousButtonText()
    {
        return $this->previousButtonText;
    }

    /**
     * Get next button text.
     *
     * @return string
     */
    final protected function getNextButtonText()
    {
        return $this->nextButtonText;
    }

    /***
     * Get "dots" text.
     *
     * @return string
     */
    final protected function getDotsText()
    {
        return $this->dotsText;
    }

}