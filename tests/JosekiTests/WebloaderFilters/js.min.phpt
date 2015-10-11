<?php

namespace JosekiTests\WebloaderFilters;

use Joseki\Webloader\JsMinFilter;
use Mockery as m;
use Nette\Configurator;
use Nette\Utils\Random;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class JsMinTest extends \Tester\TestCase
{
    public function testMin()
    {
        $file = __DIR__ . '/files/example.js';
        $code = file_get_contents($file);
        $compiler = m::mock('WebLoader\Compiler');

        $jsMin = new JsMinFilter();

        Assert::matchFile(__DIR__ . '/files/example.js.expected', $jsMin($code, $compiler));
    }



    public function testFileFilter()
    {
        $configurator = new Configurator;
        $configurator->setTempDirectory(TEMP_DIR);
        $configurator->addParameters(array('container' => array('class' => 'SystemContainer_' . Random::generate())));
        $configurator->addConfig(__DIR__ . '/files/config.js.min.neon', $configurator::NONE);
        $container = $configurator->createContainer();

        /** @var \WebLoader\Nette\LoaderFactory $webloader */
        $webloader = $container->getByType('\WebLoader\Nette\LoaderFactory');
        $jsLoader = $webloader->createJavaScriptLoader('default');

        /** @var \Webloader\Compiler $compiler */
        $compiler = $jsLoader->getCompiler();
        Assert::matchFile(__DIR__ . '/files/example.min.js.expected', $compiler->getContent());
    }

}

\run(new JsMinTest());
