<?php

namespace App\Console\Commands;

use App\Http\Models\Votes\Votes;
use App\Http\Requests\VoterPublishRequest;
use Illuminate\Console\Command;

class VoterRecalculateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate Voters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notFinishedVoters = Votes::with('votes')->where('state',  VoterPublishRequest::PUBLISH)->get();
        if(!$notFinishedVoters->count()){
            return false;
        }

        $allow = 0;
        $disallow = 0;
        $notVote = 0;
        $none = 0;

        foreach ($notFinishedVoters as $task) {
            foreach ($task->votes as $voter) {
                $total = $voter->count();
                switch ($voter->vote_value) {
                    case 1:
                        $allow++;
                        break;
                    case 2:
                        $disallow++;
                        break;
                    case 3:
                        $notVote++;
                        break;
                    default:
                        break;
                }
            }

            // TODO add orbitre, deadline, quorum and other options
            $state = $this->check($allow, $disallow, $notVote, $total);
        }
        $task->save(['state' => $state]);
    }

    private function check($allow, $disallow, $notVote, $total){
        //TODO move calculation to BD query and grouping
        if(($allow + $disallow + $notVote) < $total) {
            return VoterPublishRequest::PUBLISH;
        }

        $resuls = sort([$allow, $disallow, $notVote]);

        if($resuls[0] === $allow AND $allow > $disallow) {
            return VoterPublishRequest::ALLOWED;
        }

        if($resuls[0] === $disallow AND $disallow > $allow) {
            return VoterPublishRequest::DISALLOWED;
        }

        if($resuls[0] === $notVote AND $notVote > $allow) {
            return VoterPublishRequest::CONFLICT;
        }

    }

}
