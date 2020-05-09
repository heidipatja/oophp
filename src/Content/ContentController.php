<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\DBResetTrait;

/**
 * Controller for content
 */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use DBResetTrait;

    /**
     * Connect to database
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
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
        $db = $this->app->db;

        $sql = "SELECT * FROM content;";

        $resultset = $db->executeFetchAll($sql);

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
        $db = $this->app->db;

        $sql = "SELECT * FROM content;";

        $resultset = $db->executeFetchAll($sql);

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
        $db = $this->app->db;

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
        $db = $this->app->db;
        $request = $this->app->request;

        if (hasKeyPost("doCreate")) {
            $title = getPostContent("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $db->execute($sql, [$title]);
            $id = $db->lastInsertId();

            return $this->app->response->redirect("content/edit?id=$id");
        }
        // return $this->app->response->redirect("content/index");
    }



    /**
     * Create new page or blog post
     *
     * @return void
     */
    public function editAction()
    {
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Redigera";

        $contentId = getPostContent("contentId") ?: getGet("id");

        $sql = "SELECT * FROM content WHERE id = ?;";

        $content = $db->executeFetch($sql, [$contentId]);

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
        $contentId = getPostContent("contentId");
        $db = $this->app->db;

        $contentId = getPost("contentId") ?: getGet("id");

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

            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
            $db->execute($sql, array_values($params));

            return $this->app->response->redirect("content/admin");

        } elseif (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("content/edit?id=$contentId");
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
        $db = $this->app->db;

        $title = "Radera";

        $contentId = getGet("id");

        $sql = "SELECT * FROM content WHERE id = ?;";

        $content = $db->executeFetch($sql, [$contentId]);

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
        $db = $this->app->db;
        $contentId = getPostContent("contentId");

        if (!is_numeric($contentId)) {
            die("Not valid for content id.");
        }

        $contentId = getPostContent("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $db->execute($sql, [$contentId]);

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
     * 404 page not found
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
        }

        $page->add("content/header");
        $page->add("content/reset");

        return $page->render([
            "title" => $title,
        ]);
    }
}
