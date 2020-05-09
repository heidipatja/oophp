<?php

namespace Hepa19\Content;

/**
 * Reset content database
 *
 * @return void
 */
trait DBResetTrait
{
    /**
    * Reset database
    */
    public function reset($filename) {

        $file = ANAX_INSTALL_PATH . $filename;

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
        // $output = [];
        $status = null;
        exec($command, $output, $status);
        // $output = "<p>The command exit status was $status."
        //     . "<br>The output from the command was:</p><pre class='reset-output'>"
        //     . print_r($output, 1);
    }
}
