<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SeasonUpdateRequest;
use App\Jobs\SeasonUpdate;
use App\Repositories\ShowRepository;
use App\Repositories\SeasonRepository;

class AdminSeasonController extends Controller
{
    protected $seasonRepository;
    protected $showRepository;

    /**
     * AdminArtistController constructor.
     *
     * @param SeasonRepository $seasonRepository
     * @param ShowRepository $showRepository
     * @internal param ArtistRepository $artistRepository
     */
    public function __construct(SeasonRepository $seasonRepository, ShowRepository $showRepository)
    {
        $this->seasonRepository = $seasonRepository;
        $this->showRepository = $showRepository;
    }

    /**
     * Affiche la liste des saisons et des épisodes d'une série en fonction de son ID
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $show = $this->showRepository->getByID($id);
        $seasons = $this->seasonRepository->getSeasonsEpisodesForShowByID($id);

        return view('admin.seasons.show', compact('seasons', 'show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $show_id
     * @return \Illuminate\Http\Response
     */
    public function create($show_id)
    {
        $show = $this->showRepository->getByID($show_id);

        return view('admin.seasons.create', compact('show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $show_id
     * @return \Illuminate\Http\Response
     */
    public function edit($show_id, $season_id)
    {
        $show = $this->showRepository->getByID($show_id);
        $season = $this->seasonRepository->getSeasonEpisodesBySeasonID($season_id);

        return view('admin.seasons.edit', compact('show', 'season'));
    }

    /**
     * Mise à jour d'une saison
     *
     * @param SeasonUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SeasonUpdateRequest $request)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);

        dispatch(new SeasonUpdate($inputs));

        return redirect()->route('admin.seasons.show', $inputs['show_id'])
        ->with('status_header', 'Modification')
        ->with('status', 'La saison a été modifié');
    }


    /**
     * Suppression d'une saison
     *
     * @param $id
     */
    public function destroy($id){

    }

}
