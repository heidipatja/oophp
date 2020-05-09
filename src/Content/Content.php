<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * General class for content posts
 */
class Content
{
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
     * Check if slug already exists
     *
     * @param string $str slug to check
     *
     * @return bool
     */
    function isSlug($slug, $id) : bool
    {
        $isSlug = false;

        $sql = "SELECT slug, id FROM content WHERE slug = ? AND id NOT ?;";

        $result = $this->db->executeFetch($sql, [$slug, $id]);

        if ($result) {
            $isSlug = true;
        }

        return $isSlug;
    }

}
