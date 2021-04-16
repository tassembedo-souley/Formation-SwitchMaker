<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProduitsExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function accueil()
    {
        $produits = Produit::orderByDesc("id")->take(9)->get();
        return view("welcome", [
            "produits" => $produits,
        ]);
    }

    public function ajouterProduit()
    {
       $produit = Produit::create([
           "designation" => "Cahier",
           "description" => "La description de Cahier",
           "prix" => 500
       ]);

       dd($produit);
    }

    public function ajouterProduit2()
    {
        $produit = new Produit;
        $produit->designation = "Livre";
        $produit->description = "La description de Livre";
        $produit->prix = 1000;
        $produit->save();

        dd($produit);
    }

    public function updateProduit(Produit $produit)
    {
        // $produit = Produit::findOrFail($id);
        // dump($produit);
        $produit->designation = "Chemise";
        $produit->description = "La description de Chemise";
        $produit->prix = 6000;
        $produit->save();
        dd($produit);
    }

    public function updateProduit2($id)
    {
        // $produit =  Produit::findOrFail(2);
        // dd($produit);
        $result = Produit::where("id", $id)->update([
            "designation" => "Tricot",
            "description" => "La description de Tricot",
            "prix" => 3500,
        ]);

        dd($result);
    }

    public function supprimerProduit(int $id)
    {
        $result = Produit::destroy($id);
        dd($result);
    }

    public function createCategory()
    {

        $category = Category::create([
            "libelle" => "Vetements",
        ]);

        $produit = Produit::create([
            "category_id" => $category->id,
            "designation" => "Pantalon",
            "description" => "La description de Pantalon",
            "prix" => 5000
        ]);

        dd($produit);
    }

    public function getProduit(Produit $produit)
    {
        $category = Category::first();
        dd($category, $category->produits);

        // dd($produit->category);
    }

    public function commande()
    {
        // $user = User::create([
        //     "name" => "Issa OUEDRAOGO",
        //     "email" => "issa@gmail.com",
        //     "password" => Hash::make("admin123"),
        // ]);

        $user = User::first();
        $produit1 = Produit::first();
        $produit2 = Produit::findOrFail(2);
        // $user->produits()->attach($produit1);
        $user->produits()->attach($produit2);
        dd($user->produits);
    }

    public function collection()
    {
        $collection1 = collect([
            [
                "title" => "Mon Super livre 1",
                "price" => 5000,
                "description" => "La description du livre"
            ],
            [
                "title" => "Mon Super livre 2",
                "price" => 10000,
                "description" => "La description du livre"
            ],
            [
                "title" => "Mon Super livre 3",
                "price" => 7000,
                "description" => "La description du livre"
            ],
        ]);
        $collection1->push([
                "title" => "Mon Super livre 4",
                "price" => 25000,
                "description" => "La description du livre"
            ]);
        $nouvelleCollection = $collection1->filter(function($livre, $key){
            return $livre["price"] >= 10000;
        });

        dd($nouvelleCollection);
    }

    public function exportProduits()
    {
        return Excel::download(new ProduitsExport, "produits.xlsx");
    }
}
