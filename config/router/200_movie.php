<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "MovieController",
            "mount" => "movie",
            "handler" => "\Hepa19\Movie\MovieController",
        ],
    ]
];
