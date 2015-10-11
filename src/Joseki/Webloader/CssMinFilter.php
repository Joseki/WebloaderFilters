<?php

namespace Joseki\Webloader;

use CssMin;
use WebLoader\Compiler;

class CssMinFilter
{
    /**
     * Minify target code
     * @param string $code
     * @param Compiler $compiler
     * @param string $file
     * @return string
     */
    public function __invoke($code, Compiler $compiler, $file = '')
    {
        if (strpos($file, '.min.') !== FALSE) {
            return $code;
        }
        return CssMin::minify($code, array("remove-last-semicolon"));
    }
}
