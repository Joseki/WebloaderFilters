<?php

namespace JosekiTests\WebloaderFilters;

use Joseki\Webloader\JsMinFilter;
use Nette\Configurator;
use Nette\Utils\Random;
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

        $generated = $compiler->generate();
        Assert::equal(1, count($generated));
        $file = $generated[0]->file;
        $filePath = TEMP_DIR . '/../' . $file;
        @unlink($filePath);

        ob_start();
        $jsLoader->render();
        ob_get_clean();

        Assert::true(file_exists($filePath));
        Assert::matchFile(__DIR__ . '/files/example.min.js.expected', file_get_contents($filePath));
    }

}

\run(new JsMinTest());
