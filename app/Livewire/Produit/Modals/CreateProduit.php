<?php

namespace App\Livewire\Produit\Modals;

use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateProduit extends ModalComponent
{

    public $name;
    public $description;
    public $price;
    public $stock_quantity;

    public function render()
    {
        return view('livewire.produit.modals.create-produit');
    }

    public function create (){

        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'price.required' => "Le prix est obligatoire.",
            'price.numeric' => "Le prix doit être un nombre valide.",
            'price.min' => "Le prix ne peut pas être négatif.",
            'stock_quantity.required' => "La quantité en stock est obligatoire.",
            'stock_quantity.integer' => "La quantité en stock doit être un entier.",
            'stock_quantity.min' => "La quantité en stock ne peut pas être négative.",
        ]);

        // Logic to create the product goes here
        $produit = Produit::make([
            'nom' => mb_strtoupper($this->name, 'UTF-8'),
            'description' => $this->description,
            'prix' => $this->price,
            'stock_quantity' => $this->stock_quantity,
        ]);
        try{
            DB::beginTransaction();

            $produit->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error');
        }

        $this->dispatch('produit-created');
        $this->reset();
        
    }
}
