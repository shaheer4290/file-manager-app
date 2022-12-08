<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\FileRepository;

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

    public function __construct(FileRepository $fileRepository) {
        parent::__construct();
        
        $this->fileRepository = $fileRepository;
    }

    public function handle()
    {
        $this->fileRepository->deleteOlderRecords();
        return Command::SUCCESS;
    }
}
