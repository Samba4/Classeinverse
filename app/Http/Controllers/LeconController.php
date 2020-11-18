<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    LeconRepository,
    NotificationRepository,
    ProfesseurRepository,
    MatiereRepository
};
use App\Models\{
    User,
    Lecon
};

use App\Notifications\LeconRated;

class LeconController extends Controller
{
    /**
     * Lecon repository.
     *
     * @var \App\Repositories\LeconRepository
     */
    protected $leconRepository;

    /**
     * Matiere repository.
     *
     * @var \App\Repositories\MatiereRepository
     */
    protected $matiereRepository;

    /**
     * Professeur repository.
     *
     * @var \App\Repositories\LeconRepository
     */
    protected $professeurRepository;

    /**
     * Create a new LeconController instance.
     *
     * @param  \App\Repositories\LeconRepository $leconRepository
     * @param  \App\Repositories\ProfesseurRepository $professeurRepository
     * @param  \App\Repositories\MatiereRepository $matiereRepository
     */
    public function __construct(
        LeconRepository $leconRepository,
        ProfesseurRepository $professeurRepository,
        MatiereRepository $matiereRepository,
        NotificationRepository $notificationRepository
    ) {
        $this->leconRepository = $leconRepository;
        $this->professeurRepository = $professeurRepository;
        $this->matiereRepository = $matiereRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lecons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecon' => 'required|image|max:2000',
            'matiere_id' => 'required|exists:matieres,id',
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $this->leconRepository->store($request);

        return back()->with('ok', __("Le cours a bien été enregistrée"));
    }

    /**
     * Display a listing of the lecons for the specified matiere.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function matiere($slug)
    {
        $matiere = $this->matiereRepository->getBySlug($slug);
        $lecons = $this->leconRepository->getLeconsForMatiere($slug);

        return view('home', compact('matiere', 'lecons'));
    }

    /**
     * Display a listing of the lecons for the specified user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $lecons = $this->leconRepository->getLeconsForUser($user->id);

        return view('home', compact('user', 'lecons'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecon $lecon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $lecon->delete();

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Lecon  $lecon
     * @return \App\models\Lecon
     */
    public function descriptionUpdate(Request $request, Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $request->validate([
            'description' => 'nullable|string|max:255'
        ]);

        $lecon->description = $request->description;
        $lecon->save();

        return $lecon;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lecon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $lecon->matiere_id = $request->matiere_id;
        $lecon->save();

        return back()->with('updated', __('La matière a bien été changée !'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Lecon  $lecon
     * @return \Illuminate\Http\Response
     */
    public function adultUpdate(Request $request, Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $lecon->adult = $request->adult == 'true';
        $lecon->save();

        return response()->json();
    }

    /**
     * Display a listing of the lecons for the specified professeur.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function professeur($slug)
    {
        $professeur = $this->professeurRepository->getBySlug($slug);
        $lecons = $this->leconRepository->getLeconsForProfesseur($slug);

        return view('home', compact('professeur', 'lecons'));
    }

    /**
     * Display a listing of professeurs for lecon
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Lecon  $lecon
     * @return \Illuminate\Http\Response
     */
    public function professeurs(Request $request,  Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $professeurs = $this->professeurRepository->getProfesseursWithLecons($request->user());

        return view('lecons.professeurs', compact('professeurs', 'lecon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Lecon  $lecon
     * @return \Illuminate\Http\Response
     */
    public function professeursUpdate(Request $request, Lecon $lecon)
    {
        $this->authorize('manage', $lecon);

        $lecon->professeurs()->sync($request->professeurs);

        $path = pathinfo(parse_url(url()->previous())['path']);

        if ($path['dirname'] === '/professeur') {

            $professeur = $this->professeurRepository->getBySlug($path['basename']);

            if ($this->leconRepository->isNotInProfesseur($lecon, $professeur)) {
                return response()->json('reload');
            }
        }

        return response()->json();
    }

    /**
     * Rate the lecon.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Lecon
     * @return array
     */
    public function rate(Request $request, Lecon $lecon)
    {
        // Get authenticated user
        $user = $request->user();

        // Is user lecon owner ?
        if ($this->leconRepository->isOwner($user, $lecon)) {
            return response()->json(['status' => 'no']);
        }

        // Rating
        $rate = $this->leconRepository->rateLecon($user, $lecon, $request->value);
        $this->leconRepository->setLeconRate($lecon);

        // Notification
        $this->notificationRepository->deleteDuplicate($user, $lecon);
        $lecon->user->notify(new LeconRated($lecon, $request->value, $user->id));

        return [
            'status' => 'ok',
            'id' => $lecon->id,
            'value' => $lecon->rate,
            'count' => $lecon->users->count(),
            'rate' => $rate
        ];
    }

    /**
     * Update the clicks.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lecon
     * @return array
     */
    public function click(Request $request, Lecon $lecon)
    {
        if ($request->session()->has('lecons') && in_array($lecon->id, session('lecons'))) {
            return response()->json(['increment' => false]);
        }

        $request->session()->push('lecons', $lecon->id);

        $lecon->increment('clicks');

        return ['increment' => true];
    }
}
