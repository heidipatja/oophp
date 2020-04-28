<?php
/**
 * Namespace
 */
 namespace Hepa19\DiceV2;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $keys = array_count_values($this->serie);
        $string = "";

        for ($i = $this->min; $i <= $this->max; $i++) {
            if (!array_key_exists($i, $keys)) {
                $keys[$i] = 0;
            }
            $string .= $i . ": " . str_repeat("&bull;", $keys[$i]) . "<br>";
        }

        return $string;
    }

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $rolls = $object->getHistogramSerie();

        $this->serie = array_merge($this->serie, $rolls);

        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }
}
