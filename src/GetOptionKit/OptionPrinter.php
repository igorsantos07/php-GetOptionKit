<?php
/*
 * This file is part of the GetOptionKit package.
 *
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace GetOptionKit;
use GetOptionKit\OptionCollection;

class OptionPrinter implements OptionPrinterInterface
{
    public $specs;

    function __construct( OptionCollection $specs)
    {
        $this->specs = $specs;
    }


    /**
     * render option descriptions
     *
     * @param integer $width column width
     * @return string output
     */
    function outputOptions($width = 24)
    {
        # echo "* Available options:\n";
        $lines = array();
        foreach( $this->specs->all() as $spec ) 
        {
            $c1 = $spec->renderReadableSpec();
            if( strlen($c1) > $width ) {
                $line = sprintf("% {$width}s", $c1) . "\n" . $spec->desc;  # wrap text
            } else {
                $line = sprintf("% {$width}s   %s",$c1, $spec->desc );
            }
            $lines[] = $line;
        }
        return $lines;
    }

    /**
     * print options descriptions to stdout
     *
     */
    function printOptions()
    {
        $lines = $this->outputOptions();
        echo join( "\n" , $lines );
    }
}
