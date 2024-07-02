<?php
namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParas = [

    ];

    protected $columnMap = [

    ];

    protected $operatorMap = [
        
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

