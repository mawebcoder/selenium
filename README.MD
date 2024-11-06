
# Selenium PHP Crawler

A PHP package to automate web crawling and element retrieval using Selenium WebDriver. This package allows you to connect to a Selenium server, navigate to web pages, and interact with elements by tags, classes, IDs, and CSS selectors. The package is set up for Chrome in headless mode, making it suitable for use in server environments.

## Requirements

- PHP 7.4 or newer
- Selenium Server
- ChromeDriver
- chromium


## Using Docker
If you prefer to use Docker, a compatible Dockerfile can be found
[here](https://github.com/mawebcoder/dockerfiles/blob/master/Dockerfile).
Simply run the following commands to build and start the Selenium server

```
docker build -t selenium .
docker run -d --name selenium -p 4444:4444 selenium:latest
```
After running these commands, you can access the Selenium server by opening
http://localhost:4444 in your browser.

## Usage

### Initialization

To use the ```Crawler```, instantiate it using the ```init``` static method, which provides a preconfigured WebDriver instance connected to Selenium.

```
use Nizek\Crawler\Crawler;

$crawler = Crawler::init();
```

### Setting the URL

To set the URL for the crawler to navigate to:

```
$crawler->setUrl('https://example.com');
```


### Methods

The following methods are provided for interacting with and retrieving elements from the webpage:

#### setUrl(string $url)


Sets the URL for the crawler to visit.

    Parameters:
        $url: The URL to navigate to.
    Returns:
        Returns the Crawler instance for method chaining.

Example:

```
$crawler->setUrl('https://example.com');
```


#### parseXMLUrls()

Parses all URLs from XML content in <loc> tags. Useful for sitemaps.

    Returns:
        An array of URLs found in <loc> tags on the page.

Example:

```
$crawler->setUrl('https://example.com/sitemap.xml');
$urls = $crawler->parseXMLUrls();

foreach ($urls as $url) {
    echo $url . PHP_EOL;
}
```

#### getElementByTagName(string $tagName)

Finds the first element with the given tag name.

    Parameters:
        $tagName: The name of the tag to search for.
    Returns:
        A WebElement object representing the element.

Example:

```
$crawler->setUrl('https://example.com');
$element = $crawler->getElementByTagName('h1');
echo $element->getText();
```


#### getElementsByTagName(string $tagName)

Finds all elements with the given tag name.

    Parameters:
        $tagName: The name of the tag to search for.
    Returns:
        An array of WebElement objects representing the elements.

Example:

```
$crawler->setUrl('https://example.com');
$elements = $crawler->getElementsByTagName('a');

foreach ($elements as $element) {
    echo $element->getAttribute('href') . PHP_EOL;
}
```


#### getElementBySelector(string $className)

Finds the first element with the given selector.

    Parameters:
        $className: The name of the class to search for.
    Returns:
        A WebElement object representing the element.

Example:

```
$crawler->setUrl('https://example.com');
$element = $crawler->getElementBySelector('img.img-thumb[alt="Apple iphone 12"]');
echo $element->getAttribute('src');
```
This will find all ```img``` tags with class name ```img.thumb``` with ```alt``` value equals ```Apple iphone 12```(just like filtering page element)


#### getElementsBySelector(string $className)

Finds all elements with the given selector.

    Parameters:
        $className: The name of the class to search for.
    Returns:
        An array of WebElement objects representing the elements.

Example:

```
$crawler->setUrl('https://example.com');
$elements = $crawler->getElementsBySelector('list-item');

foreach ($elements as $element) {
    echo $element->getText() . PHP_EOL;
}
```

#### getElementByClassName(string $className)

Finds the first element with the given class name.

    Parameters:
        $className: The name of the class to search for.
    Returns:
        A WebElement object representing the element.

Example:

```
$crawler->setUrl('https://example.com');
$element = $crawler->getElementByClassName('header');
echo $element->getText();
```


#### getElementsByClassName(string $className)

Finds all elements with the given class name.

    Parameters:
        $className: The name of the class to search for.
    Returns:
        An array of WebElement objects representing the elements.

Example:

```
$crawler->setUrl('https://example.com');
$elements = $crawler->getElementsByClassName('list-item');

foreach ($elements as $element) {
    echo $element->getText() . PHP_EOL;
}
```


#### getElementById(string $id)

Finds the element with the given ID.

    Parameters:
        $id: The ID of the element to search for.
    Returns:
        A WebElement object representing the element.

Example:

```
$crawler->setUrl('https://example.com');
$element = $crawler->getElementById('main-content');
echo $element->getText();
```

#### getPageContent()

Retrieves the inner HTML content of the current page.

    Returns:
        A string containing the inner HTML of the page.

Example:

```
$crawler->setUrl('https://example.com');
$content = $crawler->getPageContent();
echo $content;
```