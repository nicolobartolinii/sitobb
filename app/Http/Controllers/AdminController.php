<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;

// contiene tutte le funzionalità che sono riservate all'amministratore, possiamo mettere un processo di autorizzazione relativo al
// ruolo dell'amministratore, vengono attivate se e solo se è admin, lo vedo sul costruttore

class AdminController extends Controller {

    protected $_adminModel;

    public function __construct() {
        $this->_adminModel = new Admin;
        $this->middleware('can:isAdmin');// qui dico che può visualizzarlo solo l'admin, chiamo il middlewear
    }

    public function index() {
        return view('admin');
    }

    public function addProduct() {
        $prodCats = $this->_adminModel->getProdsCats()->pluck('name', 'catId');
        return view('product.insert')
                        ->with('cats', $prodCats);
    }

    public function storeProduct(NewProductRequest $request) {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = NULL;
        }

        $product = new Product;
        $product->fill($request->validated());
        $product->image = $imageName;
        $product->save();

        if (!is_null($imageName)) {
            $destinationPath = public_path() . '/images/products';
            $image->move($destinationPath, $imageName);
        };

        return redirect()->action([AdminController::class, 'index']);
        ;
    }

}
