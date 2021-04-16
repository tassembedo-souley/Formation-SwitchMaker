<?php

use App\Mail\ProduitAjoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProduitController;
use App\Notifications\ModificationProduit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, "accueil"])->name('accueil');

Route::resource("produits", ProduitController::class);

Route::get("ajouter-produit", [MainController::class, "ajouterProduit"]);

Route::get("update-produit/{produit}", [MainController::class, "updateProduit"]);

Route::get("update-produit2/{id}", [MainController::class, "updateProduit2"]);

Route::get("suppression-produit/{id}", [MainController::class, "supprimerProduit"]);

Route::get("create-category", [MainController::class, "createCategory"]);

Route::get("get-produit/{produit}", [MainController::class, "getProduit"]);

Route::get("commande", [MainController::class, "commande"]);

Route::get("test-collection", [MainController::class, "collection"]);

Route::get("test-mail", function(){
    return new ProduitAjoute;
});

