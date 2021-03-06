<?php
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Inanimatt\SiteBuilder\TransformerCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\IniFileLoader;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

// Set up the service container
$sc = new ContainerBuilder;
$sc->addCompilerPass(new TransformerCompilerPass);

$searchPath = array(getcwd(), __DIR__, __DIR__.'/..');
if (defined('SITEBUILDER_ROOT')) {
    array_unshift($searchPath, SITEBUILDER_ROOT);
}

$locator = new FileLocator($searchPath);
$resolver = new LoaderResolver(array(
    new YamlFileLoader($sc, $locator),
    new IniFileLoader($sc, $locator),
));

$loader = new DelegatingLoader($resolver);
$loader->load('services.yml');

$sc->compile();
return $sc;
