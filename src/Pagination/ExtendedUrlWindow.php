<?php namespace SSD\Pagination;

use Illuminate\Pagination\UrlWindow;

class ExtendedUrlWindow extends UrlWindow
{

    /**
     * @param array $result
     * @return array
     */
    private function append(array $result)
    {
        $result['all'] = $this->paginator->getUrlRange(1, $this->lastPage());

        return $result;
    }

    /**
     * @return array
     */
    protected function getSmallSlider()
    {
        return $this->append(parent::getSmallSlider());
    }

    /**
     * Create a URL slider links.
     *
     * @param  int $onEachSide
     * @return array
     */
    protected function getUrlSlider($onEachSide)
    {
        $window = $onEachSide * 2;

        if ( ! $this->hasPages()) {
            return [
                'first' => null,
                'slider' => null,
                'last' => null,
                'all' => null
            ];
        }

        if ($this->currentPage() <= $window) {
            return $this->getSliderTooCloseToBeginning($window);
        } elseif ($this->currentPage() > ($this->lastPage() - $window)) {
            return $this->getSliderTooCloseToEnding($window);
        }

        return $this->getFullSlider($onEachSide);
    }

    /**
     * @param int $window
     * @return array
     */
    protected function getSliderTooCloseToBeginning($window)
    {
        return $this->append(parent::getSliderTooCloseToBeginning($window));
    }

    /**
     * @param int $window
     * @return array
     */
    protected function getSliderTooCloseToEnding($window)
    {
        return $this->append(parent::getSliderTooCloseToEnding($window));
    }

    /**
     * @param int $onEachSide
     * @return array
     */
    protected function getFullSlider($onEachSide)
    {
        return $this->append(parent::getFullSlider($onEachSide));
    }

}
