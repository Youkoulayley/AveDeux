<?php

namespace App\Jobs;

use App\Repositories\SeasonRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SeasonDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $seasonID;
    protected $userID;

    /**
     * Create a new job instance.
     *
     * @param $seasonID
     * @param $userID
     */
    public function __construct($seasonID, $userID)
    {
        $this->seasonID = $seasonID;
        $this->userID = $userID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SeasonRepository $seasonRepository)
    {
        $season = $seasonRepository->getSeasonByID($this->seasonID);

        $idLog = initJob($this->userID, 'Suppression', 'Season', $this->seasonID);

        $logMessage = '> SAISON ' . $season->name;
        saveLogMessage($idLog, $logMessage);

        // On récupère les épisodes
        $episodes = $season->episodes()->get();

        // Pour chaque épisode
        foreach($episodes as $episode){
            $logMessage = '>> EPISODE ' . $episode->numero;
            saveLogMessage($idLog, $logMessage);

            // On détache les artistes
            $logMessage = '>>> Détachement des artistes';
            saveLogMessage($idLog, $logMessage);
            $episode->artists()->detach();

            // On le supprime
            $logMessage = '>>> Suppression de l\'épisode';
            saveLogMessage($idLog, $logMessage);
            $episode->delete();
        }
        // On supprime la saison
        $logMessage = '>> Suppression de la saison';
        saveLogMessage($idLog, $logMessage);
        $season->delete();

        endJob($idLog);
    }
}
