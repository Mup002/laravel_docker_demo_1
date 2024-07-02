<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use App\Filters\V1\CustomerFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);
        $includeInvoices =  $request->query('includeInvoices');
        $customer = Customer::where($filterItems);

        if($includeInvoices){
            $customer = $customer->with('invoices');
        }
        return new CustomerCollection($customer->paginate($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // public function fillerCustomer(Request $request){
    //     $filter = new CustomerQuery();
    //     $queryItems = $filter->transform($request);

    //     if(count($queryItems) == 0){
    //         return new CustomerCollection(Customer::paginate());
    //     }else{
    //         return new CustomerCollection(Customer::where($queryItems)->paginate());
    //     }

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        return new CustomerResource(Customer::create($request->all()));
    }


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');

        if($includeInvoices){
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
