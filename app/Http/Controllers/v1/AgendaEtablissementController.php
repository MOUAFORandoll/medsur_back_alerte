<?

namespace App\Http\Controllers\v1;

use App\Services\AgendaEtablissementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use App\Models\NotationPatient;
use App\Models\Patient;

class AgendaEtablissementController extends Controller
{

    private $agendaService;

    /**
     * class NotationController extends Controller
     *
     * @param \App\Services\AgendaEtablissementService $agendaService
     */
    public function __construct(AgendaEtablissementService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    public function index(Request $request)
    {

        $notations =
            $this->agendaService->index($request);

        return $notations;
    }

    public function store(Request $request)
    {
        $notations =
            $this->agendaService->store($request);

        return
            $notations;
    }
}
