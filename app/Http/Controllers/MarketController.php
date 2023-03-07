<?php

namespace App\Http\Controllers;

use App\Models\marketshopping;
use App\Models\products;
use App\Models\units;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opciones = units::all();
        $opciones2 = products::all();
        //dump($opciones, $opciones2);
        return view('modules/market/market', compact('opciones', 'opciones2'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = $request->input('product');
        //dd($request);
        foreach ($productos as $nombre) {
            if ($nombre != "") {
                $producto = products::where('name', $nombre)->first();
                if (!$producto) {
                    //dump($nombre);
                    $producto = new products;
                    $producto->name = $nombre;
                    $producto->save();
                }
                // continuar con la lógica de tu aplicación...
            }
        }


        $unidades = $request->input('unit');
        foreach ($unidades as $nombre) {
            if ($nombre != "") {
                $unidad = units::where('name', $nombre)->first();
                if (!$unidad) {
                    //dump($nombre);
                    $unidad = new units;
                    $unidad->name = $nombre;
                    $unidad->save();
                }
                // continuar con la lógica de tu aplicación...
            }
        }
        $shop = new marketshopping;
        /* $prod = implode(' ', $request->input('product'));*/
        /* $unit = implode(' ', $request->input('unit')); */
        /* $quan = implode(' ', $request->input('quantity')); */

        $shop->shoppingday = $request->input('date-day');
        $shop->buyer = $request->input('comprador');
        $shop->budget = $request->input('Presupuesto');
        $shop->invoice_amount = $request->input('invoice_amount');
        $shop->product = json_encode($request->input('product'));
        $shop->unit = json_encode($request->input('unit'));
        $shop->quantity = json_encode($request->input('quantity'));
        $shop->save();

        //dd($shop);
        //$opciones = units::all();
        //$opciones2 = products::all();
        //return view('market', compact('opciones', 'opciones2'));

        // Procesar los datos enviados a través del formulario

        $request->session()->flash('mensaje', 'El formulario de compra ha sido guardado correctamente.');
        // Redirigir a la página del mercado
        return redirect()->route('market');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $day = "";
        $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
        $opciones = units::all();
        $opciones2 = products::all();
        //dump($opciones, $opciones2);
        return view('modules/market/marketinvoice', compact('comprasdeldia', 'opciones', 'opciones2'));
    }

    public function shopday(Request $request)
    {
        //dump($request);
        $day = $request->input('day');
        $supplier = $request->input('proveedor');
        //dump($day, $supplier);
        if ($supplier != null) {
            $comprasdeldia = marketshopping::where('id', $supplier)->get();
        } else {
            $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
        }
        //dump($comprasdeldia);
        $opciones = units::all();
        $opciones2 = products::all();
        return view('modules/market/marketinvoice', compact('comprasdeldia', 'opciones', 'opciones2'));
    }

    public function showcreditinvoice(Request $request)
    {
        dump($request);
        return view('modules/market/creditinvoice');
    }

    public function showbudget()
    {
        return view('modules/market/budget');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
