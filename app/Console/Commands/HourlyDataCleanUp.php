<?php

namespace App\Console\Commands;

use App\Repositories\FileRepository;
use Illuminate\Console\Command;

class HourlyDataCleanUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command cleans up data older than 30 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    private FileRepository $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct();

        $this->fileRepository = $fileRepository;
    }

    public function handle()
    {
        $deletedFiles = $this->fileRepository->deleteOlderRecords();

        echo 'Number of records cleaned up : '.$deletedFiles."\n";

        return Command::SUCCESS;
    }
}
