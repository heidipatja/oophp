<?php

namespace Hepa19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Hepa19\Content\ContentTrait;

/**
 * General class for content posts
 */
class Content
{
    use ContentTrait;

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
     * Get all content from table
     *
     * @return array $resultset
     */
    public function getAllContent() : array
    {
        $sql = "SELECT * FROM content;";
        $resultset = $this->db->executeFetchAll($sql);

        return $resultset;
    }



    /**
     * Get one content (page or post) by id
     *
     * @return object $content
     */
    public function getOneContent($contentId) : object
    {
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$contentId]);

        return $content;
    }


    /**
     * Create new content
     *
     * @return void
     */
    public function createContent($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
        $id = $this->db->lastInsertId();

        return $id;
    }



    /**
     * Edit content
     *
     * @return void
     */
    public function editContent($contentId)
    {
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->db->executeFetch($sql, [$contentId]);

        return $content;
    }



    /**
     * Save content
     *
     * @return void
     */
    public function saveContent($params)
    {
        if (!$params["contentSlug"]) {
            $params["contentSlug"] = slugify($params["contentTitle"]);
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, array_values($params));
    }



    /**
     * Delete content
     *
     * @return void
     */
    public function deleteContent($contentId)
    {
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $this->db->execute($sql, [$contentId]);
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
