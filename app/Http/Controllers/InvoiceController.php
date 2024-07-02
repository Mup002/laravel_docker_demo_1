<?php

namespace App\Http\Controllers;

use App\Filters\V1\InvoiceFilter;
use App\Http\Requests\BulkStoreInvoiceRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // return new InvoiceCollection(Invoice::paginate());

        $filter = new InvoiceFilter();
        $queryItems = $filter->transform($request);
        $invoices = Invoice::paginate();

        if(count($queryItems) !== 0){
            $invoices->appends($queryItems);
        }
        return new InvoiceCollection($invoices);

    }
    public function bulkStore(BulkStoreInvoiceRequest $request){
        $bulk = collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,['customerId','billedDate','paidDate']);
//            return $arr;
        });
        Invoice::insert($bulk->toArray());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
