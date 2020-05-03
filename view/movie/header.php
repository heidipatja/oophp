<?php

namespace Anax\View;

/**
 * Header
 */

?>

 <navbar class="navbar">
     <a href="<?= url("movie/select") ?>">SELECT *</a> |
     <a href="<?= url("movie/index") ?>">Show all movies</a> |
     <a href="<?= url("movie/reset") ?>">Reset database</a> |
     <a href="<?= url("movie/search-title") ?>">Search title</a> |
     <a href="<?= url("movie/search-year") ?>">Search year</a> |
     <a href="<?= url("movie/movie-select") ?>">Select</a> |
     <a href="<?= url("movie/show-all-sort") ?>">Show all sortable</a> |
     <a href="<?= url("movie/show-all-paginate") ?>">Show all paginate</a> |
 </navbar>
