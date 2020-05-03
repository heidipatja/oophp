<?php

namespace Hepa19\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for Movie database
 */
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Index page, connect to db and show index page
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $page = $this->app->page;
        $db = $this->app->db;
        $db->connect();

        $title = "Filmdatabas";

        $sql = "SELECT * FROM movie;";

        $resultset = $db->executeFetchAll($sql);

        $data = [
            "resultset" => $resultset,
        ];

        $page->add("movie/header");
        $page->add("movie/index", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
