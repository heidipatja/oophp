<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\ContentTrait;

/**
 * Controller for content
 */
class PostController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use ContentTrait;

    /**
     * @var ContentPost $contentpost object handling content pages
     */
     private $contentpost;

    /**
     * Connect to database
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
        $this->contentpost = new ContentPost($this->app->db);
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

        $resultset = $this->contentpost->getAllPosts();

        $data = [
            "resultset" => $resultset
        ];

        $page->add("content/header");
        $page->add("content/blog", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Index page
     *
     * @return object
     */
    public function blogpostActionGet() : object
    {
        $slug = getGet("slug");
        $page = $this->app->page;

        $content = $this->contentpost->getOnePost($slug);

        if (!$content) {
            return $this->app->response->redirect("content/pageNotFound");
        }

        $title = $content->title;

        $data = [
            "content" => $content
        ];

        $page->add("content/header");
        $page->add("content/blogpost", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
