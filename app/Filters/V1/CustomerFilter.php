<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter{
    protected $safeParas = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email'=> ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq','gt','lt']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt'=> '>'
    ];

    public function transform(Request $request){
        $eloQuery = [];
        foreach($this->safeParas as $parm => $operators){
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operators){
                if(isset($query[$operators])){
                    $eloQuery[] = [$column, $this->operatorMap[$operators], $query[$operators]];
                }
            }
        }
        return $eloQuery;
    }
}
