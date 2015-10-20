<?php namespace SSD\Pagination;

class Foundation extends Pagination
{

    /**
     * Active link partial.
     *
     * @var string
     */
    protected $activeLinkPartial = '<li class="current"><a href="">%s</a></li>';

    /**
     * Disabled link partial.
     *
     * @var string
     */
    protected $disabledLinkPartial = '<li class="unavailable"><a href="">%s</a></li>';

}