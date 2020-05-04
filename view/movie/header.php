<?php

namespace Anax\View;

/**
 * Header
 */

?>

 <navbar class="navbar">
     <a href="<?= url("movie") ?>">Visa alla</a> |
     <a href="<?= url("movie/reset") ?>">Återställ databas</a> |
     <a href="<?= url("movie/search-title") ?>">Sök på titel</a> |
     <a href="<?= url("movie/search-year") ?>">Sök på år</a> |
     <a href="<?= url("movie/movie-select") ?>">Admin</a> |
 </navbar>
