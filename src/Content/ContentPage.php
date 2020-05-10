<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Class for content pages
 */
class ContentPage
{
    /**
     * @var $db database connection
     */
     private $db;

    /**
     * Construct content class
     *
     * @return object
     */
     public function __construct($db)
     {
         $this->db = $db;
         $this->db->connect();
     }


     /**
      * Get all pages from table
      *
      * @return array $resultset Array with all pages
      */
     public function getAllPages() : array
     {
         $sql = "
         SELECT
         *,
         CASE
         WHEN (deleted <= NOW()) THEN 'isDeleted'
         WHEN (published <= NOW()) THEN 'isPublished'
         ELSE 'notPublished'
         END AS status
         FROM content
         WHERE type=?
         ;";

         $resultset = $this->db->executeFetchAll($sql, ["page"]);

         return $resultset;
     }



     /**
      * Get one page
      *
      * @return object $content One page
      */
     public function getOnePage($route) : object
     {
         $sql = "
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
         ;";

         $content = $this->db->executeFetch($sql, [$route, "page"]);

         return $content;
     }
}
