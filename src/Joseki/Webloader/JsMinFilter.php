<?php

namespace Joseki\Webloader;

use JShrink\Minifier;
use WebLoader\Compiler;

class JsMinFilter
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

        return Minifier::minify($code);
    }
}
