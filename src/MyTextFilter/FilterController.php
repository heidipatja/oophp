<?php

namespace Hepa19\MyTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for Movie database
 */
/** * @SuppressWarnings(PHPMD.TooManyPublicMethods) * @return bool */
class FilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Index page for text filter
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Textfilter";
        $page = $this->app->page;

        $page->add("filter/header");
        $page->add("filter/index");

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * BBCode text
     *
     * @return object
     */
    public function bbcodeActionGet() : object
    {
        $title = "BBCode";
        $page = $this->app->page;

        $bbcodefilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "../../../htdocs/text/bbcode.txt");
        $filter = ["bbcode", "nl2br"];

        $html = $bbcodefilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("filter/header");
        $page->add("filter/bbcode", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Index page for text filter
     *
     * @return object
     */
    public function markdownActionGet() : object
    {
        $title = "Markdown";
        $page = $this->app->page;

        $page->add("filter/header");
        $page->add("filter/markdown");

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Index page for text filter
     *
     * @return object
     */
    public function clickableActionGet() : object
    {
        $title = "Klickbara länkar";
        $page = $this->app->page;

        $page->add("filter/header");
        $page->add("filter/clickable");

        return $page->render([
            "title" => $title
        ]);
    }
}