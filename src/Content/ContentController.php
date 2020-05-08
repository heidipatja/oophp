<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for content
 */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;

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

        $page->add("content/index", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
