<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UserStore
 * @package App\Jobs
 */
class UserStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inputs;

    /**
     * Create a new job instance.
     *
     * @param $inputs
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*
       |--------------------------------------------------------------------------
       | Initialisation du job
       |--------------------------------------------------------------------------
       */
        $idLog = initJob($this->inputs['user_id'], 'Ajout', 'User', mt_rand());

        $user = new User();

        $message = 'Username : ' . $this->inputs['username'];
        saveLogMessage($idLog, $message);
        $user->username = $this->inputs['username'];

        $message = 'Rôle : ' . $this->inputs['role'];
        saveLogMessage($idLog, $message);
        $user->role = $this->inputs['role'];

        $user->password = bcrypt($this->inputs['password']);
        $user->activated = 1;

        $message = 'E-Mail : ' . $this->inputs['email'];
        saveLogMessage($idLog, $message);
        $user->email = $this->inputs['email'];

        $message = 'Edito : ' . $this->inputs['edito'];
        saveLogMessage($idLog, $message);
        $user->edito = $this->inputs['edito'];

        $message = 'Antispoiler : ' . $this->inputs['antispoiler'];
        saveLogMessage($idLog, $message);
        $user->antispoiler = $this->inputs['antispoiler'];

        $message = 'Site Internet : ' . $this->inputs['website'];
        saveLogMessage($idLog, $message);
        $user->website = $this->inputs['website'];

        $message = 'Twitter : ' . $this->inputs['twitter'];
        saveLogMessage($idLog, $message);
        $user->twitter = $this->inputs['twitter'];

        $message = 'Facebook : ' . $this->inputs['facebook'];
        saveLogMessage($idLog, $message);
        $user->facebook = $this->inputs['facebook'];

        $user->save();

        endJob($idLog);
    }
}
