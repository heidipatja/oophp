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
        CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
        END AS status
        FROM content
        WHERE type=?
        ;
        EOD;

        $resultset = $db->executeFetchAll($sql, ["page"]);

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
        $db = $this->app->db;

        $sql = <<<EOD
            SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
            FROM content
            WHERE
            path = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
            ;
            EOD;

        $content = $db->executeFetch($sql, [$route, "page"]);

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
