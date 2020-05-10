<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\DBResetTrait;

/**
 * Controller for content
 */
/** * @SuppressWarnings(PHPMD.TooManyPublicMethods) * @return bool */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use DBResetTrait;

    /**
     * @var Content Content object handling content
     */
    private $content;

    /**
     * Connect to database
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
        $this->content = new Content($this->app->db);
    }


    /**
     * Index page
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Översikt över innehållet";
        $page = $this->app->page;

        $resultset = $this->content->getAllContent();

        $data = [
            "resultset" => $resultset
        ];

        $page->add("content/header");
        $page->add("content/index", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Admin page, show all posts
     *
     * @return object
     */
    public function adminActionGet() : object
    {
        $title = "Admin";
        $page = $this->app->page;

        $resultset = $this->content->getAllContent();

        $data = [
            "resultset" => $resultset
        ];

        $page->add("content/header");
        $page->add("content/admin", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Create new page or blog post
     *
     * @return object
     */
    public function createActionGet() : object
    {
        $page = $this->app->page;

        $title = "Nytt inlägg";

        $page->add("content/header");
        $page->add("content/create");

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function createActionPost()
    {
        if (hasKeyPost("doCreate")) {
            $title = getPostContent("contentTitle");

            $id = $this->content->createContent($title);

            return $this->app->response->redirect("content/edit?id=$id");
        }
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function editAction()
    {
        $page = $this->app->page;

        $title = "Redigera";

        $contentId = getPostContent("contentId") ?: getGet("id");

        $content = $this->content->editContent($contentId);

        $data = [
            "content" => $content
        ];

        $page->add("content/header");
        $page->add("content/edit", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function editActionPost()
    {
        $contentId = getPostContent("contentId") ?: getGet("id");

        if (hasKeyPost("doSave")) {
            $params = getPostContent([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            $this->content->saveContent($params);

            return $this->app->response->redirect("content/admin");
        } elseif (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("content/delete?id=$contentId");
        } else {
            return $this->app->response->redirect("content/edit?contentId=$contentId");
        }
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function deleteActionGet()
    {
        $page = $this->app->page;
        $title = "Radera";

        $contentId = getGet("id");
        $content = $this->content->getOneContent($contentId);

        $data = [
            "content" => $content
        ];

        $page->add("content/header");
        $page->add("content/delete", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function deleteActionPost()
    {
        $contentId = getPostContent("contentId");

        if (!is_numeric($contentId)) {
            $this->app->response->redirect("content/pageNotFound");
        }

        $this->content->deleteContent($contentId);

        $this->app->response->redirect("content/admin");
    }



    /**
     *
     * 404 page not found
     *
     * @return object
     */
    public function pageNotFoundActionGet() : object
    {
        $page = $this->app->page;
        $title = "404 Page not found";

        $page->add("content/header");
        $page->add("content/404");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     *
     * Reset database
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $page = $this->app->page;
        $title = "Återställ databasen";

        $doReset = getGet("reset");

        if ($doReset) {
            $filename = "/sql/content/setup.sql";
            $this->reset($filename);
            $this->app->response->redirect("content/admin");
        }

        $page->add("content/header");
        $page->add("content/reset");

        return $page->render([
            "title" => $title,
        ]);
    }
}
