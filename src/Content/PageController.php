<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for content
 */
class PageController implements AppInjectableInterface
{
    use AppInjectableTrait;

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
        $path = getGet("path");
        $slug = getGet("slug");
        $page = $this->app->page;

        $content = $this->contentpage->getOnePage($path);

        if (!$content) {
            return $this->app->response->redirect("content/pageNotFound");
        }

        $title = $content->title;
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
