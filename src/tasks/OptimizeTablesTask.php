<?php

namespace Pikselin\base\Tasks;


use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use Symfony\Component\Console\Input\InputInterface;
use SilverStripe\PolyExecution\PolyOutput;

class OptimizeTablesTask extends BuildTask
{

    protected string $title = 'OptimizeTablesTask';

    protected static string $description = 'Optimizes database tables via the SQL optimize table command.';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $tables = DB::query('SHOW TABLES');

        foreach ($tables as $table) {
            // The key name changes depending on DB name, so grab the first value
            $tableName = array_values($table)[0];

            $output->writeln(sprintf('Optimizing table: <info>%s</info>', $tableName));
            $res = DB::query(sprintf('OPTIMIZE TABLE `%s`', $tableName))->value();
            $output->writeln($res);
        }

        $output->writeln('<info>All tables optimized successfully.</info>');

        return 0; // success exit code
    }
}
