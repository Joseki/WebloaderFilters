<?php

namespace Joseki\Webloader;

use JShrink\Minifier;

class JsMinFilter
{
    /**
     * Minify target code
     * @param string $code
     * @return string
     */
    public function __invoke($code)
    {
        return Minifier::minify($code);
    }
}
