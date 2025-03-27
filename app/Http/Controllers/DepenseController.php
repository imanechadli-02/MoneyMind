<?php
namespace App\Http\Controllers;

use App\Models\Aleart;
use App\Models\AleartConfig;
use App\Models\Categorie;
use App\Models\Depense;
use App\Models\User;
use App\Notifications\aleartNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        $depenses = Depense::where("user_id", Auth::id())->with("categorie")->get();
        $totalDepenses = Auth::user()->depenses()->sum('prix');

        $depensesParCategorie = Auth::user()->depenses()
            ->select('categorie_id', \DB::raw('SUM(prix) as total'))
            ->groupBy('categorie_id')
            ->with("categorie")->get();

        return view("utilisateur/depenses", compact("categories", "depenses", "totalDepenses", "depensesParCategorie"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'          => ['required', 'string', 'max:255'],
            'prix'         => ['required', 'numeric'],
            'categorie_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        Depense::create([
            'nom'          => $request->nom,
            'prix'         => $request->prix,
            'categorie_id' => $request->categorie_id,
            'user_id'      => Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'Budjet' => $user->Budjet - $request->prix,
        ]);

        // Gestion du seuil global
        $seuilglobal = AleartConfig::where('user_id', $user->id)->where('seuilType', 'seuil_global')->first();

        if ($seuilglobal) {
            $seuilglobal->pourcentage_actuel += ($request->prix / $user->salaire) * 100;
            $seuilglobal->save();

            if ($seuilglobal->pourcentage_actuel >= $seuilglobal->pourcentage) {
                $message = "Vous avez dépassé {$seuilglobal->pourcentage}% de votre seuil global. (Votre pourcentage maintenant : {$seuilglobal->pourcentage_actuel}%).";
                Notification::send($user, new aleartNotification($message));

                Aleart::create([
                    'mssg'     => $message,
                    'user_id'  => $user->id,
                ]);
            }
        }

        // Gestion du seuil par catégorie
        if ($request->categorie_id) {
            $config = AleartConfig::where('user_id', $user->id)->where('categorie_id', $request->categorie_id)->first();

            if ($config) {
                $config->pourcentage_actuel += ($request->prix / $user->salaire) * 100;
                $config->save();

                if ($config->pourcentage_actuel >= $config->pourcentage) {
                    $message = "Vous avez dépassé {$config->pourcentage}% de votre seuil pour la catégorie '{$config->categorie->title}'. (Votre pourcentage maintenant : {$config->pourcentage_actuel}%).";
                    Notification::send($user, new aleartNotification($message));

                    Aleart::create([
                        'mssg'         => $message,
                        'categorie_id' => $config->categorie->id,
                        'user_id'      => $user->id,
                    ]);
                }
            }
        }

        return redirect()->route('utilisateur.depenses');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nom'          => ['required', 'string', 'max:255'],
            'prix'         => ['required', 'numeric'],
            'categorie_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $souhait = Depense::findOrFail($request->depense_id);
        $souhait->update([
            'nom'          => $request->nom,
            'prix'         => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('utilisateur.depenses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depense = Depense::findOrFail($id);
        $depense->delete();

        return redirect()->route('utilisateur.depenses');
    }
}
