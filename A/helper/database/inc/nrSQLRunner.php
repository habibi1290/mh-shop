<?php
/**
 * Runs one or multiple SQL files in OXID Environment
 *
 * --------------------------------------------------------------------------------------------------------------------
 *
 * @package         grunt-tasks\Helpers
 * @copyright       ©2018 norisk GmbH
 *
 * @author          Amely Kling <akling@noriskshop.de> - *Initial development*
 *
 */
/* Get & do Migrations
 * =================================================================================================================== */

class nrSQLRunner
{
    protected $errors = array();
    protected $connection;

    /* Constructor
     * --------------------------------------------------------------------------------------------------------------- */

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /* Public Methods
     * --------------------------------------------------------------------------------------------------------------- */

    public function run($migrations)
    {
        $this->runMultipleFiles($migrations);

        if (count($this->errors) > 0) {
            echo "Migrations failed:";
            foreach ($this->errors as $error) {
                print($error . '');
            }
            echo "See log above for details";
            exit(1);
        } else {
            echo "Migrations successful!\n";
            exit(0);
        }
    }

    /**
     * runFile
     * -----------------------------------------------------------------------------------------------------------------
     * runs one SQL file
     *
     * @param string $filename
     * @returns boolean
     */
    public function runFile($filename)
    {
        // read migration file
        $import = file_get_contents($filename);

        // remove comments
        $import = preg_replace("%/\*(.*)\*/%Us", '', $import);
        $import = preg_replace("%^--(.*)\n%mU", '', $import);
        $import = preg_replace("%^$\n%mU", '', $import);

        // escaping
        mysqli_real_escape_string($this->connection, $import);

        // split into single statements (";" and the end of a line is the delimiter)
        $sql_statements = preg_split("/;[\n\r]/", $import);
        // Trim whitespaces from start and end of the queries
        $sql_statements = array_map(function ($statement) { return trim($statement); }, $sql_statements);
        // Remove all empty "queries"
        $sql_statements = array_filter($sql_statements);

        // loop through statements
        foreach ($sql_statements as $sql) {
            // run query
            if (!mysqli_query($this->connection, $sql)) {
                print('Error performing migration:' . $filename . ' \n\'' . $sql . "':\n" . mysqli_error($this->connection) . "\n\n");
                $this->errors[] = 'Error performing migration: ' . $filename . "\n";
            }
        }

        // return status
        return count($this->errors) === 0;
    }

    /**
     * runMultipleFiles
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @param string[] $files
     */
    public function runMultipleFiles($files)
    {
        foreach ($files as $filename) {
            $this->runFile($filename);
        }
    }
}