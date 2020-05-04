<?php

namespace Hepa19\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for Movie database
 */
/** * @SuppressWarnings(PHPMD.TooManyPublicMethods) * @return bool */
class MovieController implements AppInjectableInterface
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
     * Index page, connect to db and show index page
     *
     * @return object
     */
    /** * @SuppressWarnings(PHPMD.CyclomaticComplexity) * @return bool */
    public function indexActionGet() : object
    {
        $db = $this->app->db;

        $title = "Filmdatabasen";

        // Get number of hits per page
        $hits = getGet("hits", 4);
        if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
            return $this->app->response->redirect("movie");
        }

        // Get max number of pages
        $sql = "SELECT COUNT(id) AS max FROM movie;";
        $max = $db->executeFetchAll($sql);
        $max = ceil($max[0]->max / $hits);

        // Get current page
        $page = getGet("page", 1);
        if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
            return $this->app->response->redirect("movie");
        }
        $offset = $hits * ($page - 1);

        // Only these values are valid
        $columns = ["id", "title", "year", "image"];
        $orders = ["asc", "desc"];

        // Get settings from GET or use defaults
        $orderBy = getGet("orderby") ?: "id";
        $order = getGet("order") ?: "asc";

        // Incoming matches valid value sets
        if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
            return $this->app->response->redirect("movie");
        }

        $sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
        $resultset = $db->executeFetchAll($sql);

        $data = [
            "resultset" => $resultset,
            "max" => $max
        ];

        $page = $this->app->page;
        $page->add("movie/header");
        $page->add("movie/index", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Search movie title
     *
     * @return object
     */
    public function searchTitleActionGet() : object
    {
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Sök filmtitel - Filmdatabasen";
        $searchTitle = getGet("searchTitle");

        if ($searchTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $db->executeFetchAll($sql, [$searchTitle]);
        }

        $data = [
            "resultset" => $resultset ?? null,
            "searchTitle" => $searchTitle ?? null
        ];

        $page->add("movie/header");
        $page->add("movie/search-title", $data);
        $page->add("movie/show-all", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Search movie year
     *
     * @return object
     */
    public function searchYearActionGet() : object
    {
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Sök filmår - Filmdatabasen";
        $year1 = getGet("year1");
        $year2 = getGet("year2");

        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $db->executeFetchAll($sql, [$year2]);
        }

        $data = [
            "resultset" => $resultset ?? null,
            "year1" => $year1,
            "year2" => $year2
        ];

        $page->add("movie/header");
        $page->add("movie/search-year", $data);
        $page->add("movie/show-all", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Select a movie
     *
     * @return object
     */
    public function movieSelectActionGet() : object
    {
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Välj film - Filmdatabasen";
        $sql = "SELECT id, title FROM movie;";
        $movies = $db->executeFetchAll($sql);

        $data = [
            "movies" => $movies ?? null,
        ];

        $page->add("movie/header");
        $page->add("movie/movie-select", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * CRUD redirect to add, edit or delete
     *
     * @return void
     */
    public function movieSelectActionPost()
    {
        $response = $this->app->response;
        $db = $this->app->db;

        $movieId = getPost("movieId");

        if (!$movieId && getPost("doEdit")) {
            return $this->app->response->redirect("movie/movie-select");
        }

        if (getPost("doDelete")) {
            $this->movieDeleteActionPost($movieId);
            return $response->redirect("movie/movie-select");
        } elseif (getPost("doAdd")) {
            $this->movieAddActionPost();
            $movieId = $db->lastInsertId();
            return $response->redirect("movie/movie-edit?movieId=$movieId");
        } elseif (getPost("doEdit") && is_numeric($movieId)) {
            return $response->redirect("movie/movie-edit?movieId=$movieId");
        }
    }



    /**
     * Delete a movie
     *
     * @return object
     */
    public function movieDeleteActionPost($movieId) : object
    {
        $db = $this->app->db;

        $sql = "DELETE FROM movie WHERE id = ?;";
        $db->execute($sql, [$movieId]);

        $this->app->response->redirect("movie/movie-select");
    }



    /**
     * Edit a movie
     *
     * @return object
     */
    public function movieEditActionGet() : object
    {
        $page = $this->app->page;
        $db = $this->app->db;

        $title = "Editera film - Filmdatabasen";
        $movieId = getGet("movieId");

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $db->executeFetchAll($sql, [$movieId]);
        $movie = $movie[0];

        $data = [
            "movie" => $movie ?? null,
        ];

        $page->add("movie/header");
        $page->add("movie/movie-edit", $data);

        return $page->render([
            "title" => $title
        ]);
    }



    /**
     * Save (post) changes
     *
     * @return object
     */
    public function movieEditActionPost() : object
    {
        $db = $this->app->db;

        $movieId    = getPost("movieId") ?: getGet("movieId");
        $movieTitle = getPost("movieTitle");
        $movieYear  = getPost("movieYear");
        $movieImage = getPost("movieImage");

        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        return $this->app->response->redirect("movie/movie-select");
    }



    /**
     * Add a movie
     *
     * @return object
     */
    public function movieAddActionPost() : object
    {
        $db = $this->app->db;

        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $db->lastInsertId();

        return $this->app->response->redirect("movie/movie-edit?movieId=$movieId");
    }



    /**
     * Reset database
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $page = $this->app->page;

        $output = null;
        $doReset = getGet("reset") ?? null;

        if ($doReset) {
            $file   = ANAX_INSTALL_PATH . "/sql/movie/setup.sql";

            if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
                $mysql = "/usr/bin/mysql";
            } else {
                $mysql = "/Applications/XAMPP/bin/mysql";
            }

            $output = null;
            $databaseConfig = $this->app->configuration->load("database");
            // var_dump($databaseConfig);
            $dsnDetail = [];
            preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["config"]["dsn"], $dsnDetail);
            $host = $dsnDetail[1];
            $database = $dsnDetail[2];
            $username = $databaseConfig["config"]["username"];
            $password = $databaseConfig["config"]["password"];

            $command = "$mysql -h{$host} -u{$username} -p{$password} $database < $file 2>&1";
            $output = [];
            $status = null;
            exec($command, $output, $status);
            $output = "<p>The command exit status was $status."
                . "<br>The output from the command was:</p><pre class='reset-output'>"
                . print_r($output, 1);
        }

        $title = "Återställ databasen - Filmdatabasen";

        $data = [
            "output" => $output,
        ];

        $page->add("movie/header");
        $page->add("movie/reset", $data);

        return $page->render([
            "title" => $title
        ]);
    }
}
