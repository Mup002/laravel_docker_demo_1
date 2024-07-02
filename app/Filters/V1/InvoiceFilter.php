<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter{
//     $table->id();
//     $table->integer('customer_id');
//     $table->integer('amount');
//     $table->string('status');
//     $table->dateTime('billed_date');
//     $table->dateTime('paid_date')->nullable();
//     $table->timestamps();
// });
    protected $safeParas=[
        'customerId' => ['eq'],
        'amount' => ['eq','lt','gt'],
        'billedDate' => ['eq'],
        'paidDate' => ['eq'],
        'status' => ['eq'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<'
    ];
}
