<?php

namespace App\Http\Controllers;

use App\ShoppingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ShoppingItemController extends Controller
{
    public function index(){
        $products = ShoppingItem::all();

        return view('shopping-items.products', compact('products', $products));
    }

    public function addIndex(){
        return view('shopping-items.add');
    }

    public function getItems(){
        return ShoppingItem::whereStatus('Active')
            ->get();
    }

    public function createProduct(Request $request){
        $this->createProductRules($request->all())->validate();

        DB::beginTransaction();
        try {
            $product = ShoppingItem::create([
                'name'     => $request->name,
                'category' => $request->category,
                'status'   => $request->status,
                'price'    => $request->price,
            ]);

            $product->addMediaFromRequest('file')->toMediaCollection('products');
            DB::commit();

            return redirect('/shopping-items')
                ->with(['info' => 'Product added successfully!']);
        } catch (\Exception $exception) {
            //return $exception;
            DB::rollback();

            Log::debug($exception->getMessage());

            return redirect()->back()
                ->with(['error' => 'Product could not be added!']);

        }


    }

    public function updateProduct(Request $request){

        $this->updateProductRules($request->all())->validate();
        $product = ShoppingItem::find($request->id);

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->category = $request->category;
            $product->price = $request->price;
            $product->status = $request->status;


            $product->save();

            if ($request->file) {
                $product->addMediaFromRequest('file')->toMediaCollection('products');
            }


            DB::commit();

            return redirect('/shopping-items')->with(['status' => 'Product Updated Successfully']);
        } catch (\Exception $e) {
            return $e;
            DB::rollback();

            Log::debug($e->getMessage());

            return redirect()->back()
                ->with(['error' => 'Error Occurred']);
        }


    }

    public function viewProduct($id){
        $product = ShoppingItem::find($id);
        if (empty($product)) {
            abort(404);
        };

        //return $product;

        return view('shopping-items.product',compact('product',$product));

    }



    private function createProductRules(array $data){
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'category' => 'required',
            'price'    => 'required | numeric',
            'file'     => 'file | image|mimes:jpeg,png,jpg,gif,svg',
        ]);


    }
    private function updateProductRules(array $data){
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'category' => 'required',
            'price'    => 'required | numeric',
        ]);


    }
}
