<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\ContentTrait;

/**
 * Controller for content
 */
class PageController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use ContentTrait;

    /**
     * @var ContentPage $contentpage object handling content pages
     */
     private $contentpage;


    /**
     * Connect to database
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
        $this->contentpage = new ContentPage($this->app->db);
    }


    /**
     * Index page, all blog posts
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Alla sidor";
        $page = $this->app->page;

        $resultset = $this->contentpage->getAllPages();

        $data = [
            "resultset" => $resultset
        ];

        $page->add("content/header");
        $page->add("content/pages", $data);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * Index page
     *
     * @return object
     */
    public function pageActionGet() : object
    {
        $route = getGet("route");
        $page = $this->app->page;

        $content = $this->contentpage->getOnePage($route);

        if (!$content) {
            return $this->app->response->redirect("content/pageNotFound");
        }

        $title = $content->title;
        $content = $this->filter($content);

        $data = [
            "content" => $content
        ];

        $page->add("content/header");
        $page->add("content/page", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
