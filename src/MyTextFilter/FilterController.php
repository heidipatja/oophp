<?php

namespace Hepa19\MyTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for text filters
 */
class FilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Index page, in case someone tries to go there...
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $this->app->response->redirect("filter/bbcode");
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
     * Markdown filter
     *
     * @return object
     */
    public function markdownActionGet() : object
    {
        $title = "Markdown";
        $page = $this->app->page;

        $mdfilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "../../../htdocs/text/sample.md");
        $filter = ["markdown"];

        $html = $mdfilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("filter/header");
        $page->add("filter/markdown", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Clickable filter
     *
     * @return object
     */
    public function clickableActionGet() : object
    {
        $title = "Clickable";
        $page = $this->app->page;

        $linkfilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "../../../htdocs/text/clickable.txt");
        $filter = ["link"];

        $html = $linkfilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("filter/header");
        $page->add("filter/clickable", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
