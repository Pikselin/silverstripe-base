<?php

namespace Pikselin\base\Tasks;


use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;

class OptimizeTablesTask extends BuildTask
{

    protected $title = 'OptimizeTablesTask';

    protected $description = 'Optimizes database tables via the SQL optimize table command.';

    public function run($request)
    {
        $tables = DB::query('SHOW TABLES');
        //print_r($tables);
        foreach ($tables as $table) {
            echo $table['Tables_in_db'].'<br>';
            $res = DB::query('OPTIMIZE TABLE `'.$table['Tables_in_db'].'`')->value();
            print($res);
        }

    }
}
