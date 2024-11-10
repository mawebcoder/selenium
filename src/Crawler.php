<?php

namespace Nizek\Crawler;

use LocatorStrategy;
use WebDriver;
use DOMDocument;
use DOMXPath;
use WebElement;

class Crawler
{

    public WebDriver $driver;

    public function __construct()
    {

        require __DIR__ . '/php-webdriver-bindings-0.9.1/phpwebdriver/WebDriver.php';

        $this->driver = new WebDriver($this->getHost(), $this->getPort());

        $this->driver->connect(browserName: 'chrome', caps: $this->getCapabilities());
    }

    private function getHost(): string
    {
        return getenv('SELENIUM_HOST') ?: 'localhost';
    }

    public function getPort(): string
    {
        return getenv('SELENIUM_PORT') ?: 444;
    }

    private function getCapabilities(): array
    {
        return [
            'browserName' => 'chrome',
            'goog:chromeOptions' => [
                'args' => [
                    '--headless',
                    '--disable-gpu',
                    '--window-size=1920,1080',
                    '--disable-extensions',
                    '--incognito',
                    '--no-sandbox',
                    '--disable-dev-shm-usage',
                    '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36',
                ],
            ]
        ];
    }

    public function setUrl(string $url): static
    {
        $this->driver->get($url);

        return $this;
    }

    public function parseXMLUrls(): array
    {
        $content = $this->driver->executeScript("return document.documentElement.innerHTML;", []);

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);

        $dom->loadHTML($content);


        $xpath = new DOMXPath($dom);


        $locElements = $xpath->query('//loc');

        $urls = [];

        foreach ($locElements as $loc) {
            $urls[] = $loc->nodeValue;
        }

        return $urls;
    }

    public static function init(): static
    {
        return new self();
    }

    public function getElementByTagName(string $tagName): WebElement
    {
        return $this->driver->findElementBy(LocatorStrategy::tagName, $tagName);
    }

    public function getPageContent(): string
    {
        return $this->driver->executeScript("return document.documentElement.innerHTML;", []);
    }

    public function getElementsByTagName(string $tagName): array
    {
        return $this->driver->findElementsBy(LocatorStrategy::tagName, $tagName);
    }

    public function getElementByClassName(string $className): WebElement
    {
        return $this->driver->findElementBy(LocatorStrategy::className, $className);
    }

    public function getElementsByClassName(string $className): array
    {
        return $this->driver->findElementsBy(LocatorStrategy::className, $className);
    }

    public function getElementById(string $id): WebElement
    {
        return $this->driver->findElementBy(LocatorStrategy::id, $id);
    }

    public function getElementBySelector(string $selector): WebElement
    {
        return $this->driver->findElementBy(LocatorStrategy::cssSelector, $selector);
    }

    public function getElementsBySelector(string $selector): array
    {
        return $this->driver->findElementsBy(LocatorStrategy::cssSelector, $selector);
    }
}