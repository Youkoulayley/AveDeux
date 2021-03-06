<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\EpisodesBySeasonIDTransformer;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Youkoulayley\ApiHandler\Facades\ApiHandler;

/**
 * Class EpisodesBySeasonIDController.
 */
class EpisodesBySeasonIDController extends Controller
{
    use Helpers;

    /**
     * @param $season_id
     *
     * @return Response
     */
    public function index($season_id)
    {
        $episodes = DB::table('episodes')->select('id', 'numero', 'name', 'name_fr', 'diffusion_us')->where('season_id', '=', $season_id)->orderBy('diffusion_us');

        $episodes = ApiHandler::parseMultiple($episodes, ['name', 'name_fr'])->getResult();

        return $this->response->collection($episodes, new EpisodesBySeasonIDTransformer());
    }
}
