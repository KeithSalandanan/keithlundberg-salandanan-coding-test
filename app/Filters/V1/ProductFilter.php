<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class ProductFilter {
    protected $allowedParams = [
        'name' => ['eq'],
        'description' => ['eq'],
        'price' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'price' => 'price'
    ];

    protected $operatorParams = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '≤',
        'gt' => '>',
        'gte' => '≥'
    ];

    public function transform(Request $request){
        $querylist = [];

        foreach ($this->allowedParams as $param => $operators){
            $query = $request->query($param);

            if(!isset($query)){
                continue;
            }

            $column = $param;

            foreach($operators as $operator){
                if (isset($query[$operator])) {
                    $querylist[] = [$column, $this->operatorParams[$operator], $query[$operator]];
                }
            }
        }
        return $querylist;
    }
}
