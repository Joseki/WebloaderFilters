<?php

namespace Joseki\Webloader;

use CssMin;

class CssMinFilter
{
    /**
     * Minify target code
     * @param string $code
     * @return string
     */
    public function __invoke($code)
    {
        return CssMin::minify($code, array("remove-last-semicolon"));
    }
}
