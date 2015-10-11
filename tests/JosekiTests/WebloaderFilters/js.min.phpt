<?php

namespace JosekiTests\WebloaderFilters;

use Joseki\Webloader\JsMinFilter;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class JsMinTest extends \Tester\TestCase
{
    public function testMin()
    {
        $content = file_get_contents(__DIR__ . '/files/example.js');
        $jsMin = new JsMinFilter();

        Assert::matchFile(__DIR__ . '/files/example.js.expected', $jsMin($content));
    }

}

\run(new JsMinTest());
