<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                    [
                        "text" => "Kmom07-10",
                        "url" => "redovisning/kmom10",
                        "title" => "Redovisning för kmom07-10.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Spel",
            "url" => "spel",
            "title" => "Spela spel",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Gissa",
                        "url" => "spel/guess/play",
                        "title" => "Gissa mitt nummer",
                    ],
                    [
                        "text" => "Tärning",
                        "url" => "spel/dice/init",
                        "title" => "Tärningsspelet 100",
                    ],
                    [
                        "text" => "Tärning v2",
                        "url" => "spel/dice2/init",
                        "title" => "Tärningsspelet 100 v2",
                    ],
                ],
            ],
        ],
        // [
        //     "text" => "Docs",
        //     "url" => "dokumentation",
        //     "title" => "Dokumentation av ramverk och liknande.",
        // ],
        [
            "text" => "Filmer",
            "url" => "movie",
            "title" => "Filmdatabas",
        ],
        // [
        //     "text" => "Test",
        //     "url" => "lek",
        //     "title" => "Testa och lek med test- och exempelprogram",
        // ],
        [
            "text" => "Dev",
            "url" => "dev",
            "title" => "Anax development utilities",
        ],
    ],
];
