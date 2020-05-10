<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\ContentTrait;

/**
 * Controller for content
 */
class BlogController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use ContentTrait;

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
     * Index page, all blog posts
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Alla sidor";
        $page = $this->app->page;
        $db = $this->app->db;

        $sql = <<<EOD
        SELECT
        *,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type=?
        ORDER BY published DESC
        ;
        EOD;
        $resultset = $db->executeFetchAll($sql, ["post"]);

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
        $db = $this->app->db;

        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE
            slug = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ORDER BY published DESC
        ;
        EOD;

        $content = $db->executeFetch($sql, [$slug, "post"]);

        if (!$content) {
            return $this->app->response->redirect("content/pageNotFound");
        }

        $title = $content->title;

        $content = $this->filter($content);

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
