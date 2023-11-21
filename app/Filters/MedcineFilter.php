<?php
namespace App\Filters; 

use Illuminate\Http\Request;

class MedcineFilter{
    protected $safeParms =[
        'category_id'=>['eq'],
        'enUseName'=>['eq'],
        'enSciName'=>['eq'],
        'price'=>['eq','lt','gt'],
        'qtn'=>['eq','lt','gt','lte','gte']
    ];
    protected $operatorMap=[
        'eq'=>'=',
        'lt'=>'<',
        'lte'=>'<=',
        'gt'=>'>',
        'gte'=>'>='
    ];
    public function transform(Request $request){
        $eleQuery=[];

        foreach($this->safeParms as $parm=>$operators){
            $query=$request->query($parm);
            if(! isset($query)){
                continue;
            }
            
            foreach($operators as $operater){
                if(isset($query[$operater])){
                    $eleQuery[]=[$parm,$this->operatorMap[$operater],$query[$operater]];
                }
            }

        }
        return $eleQuery;
    }

}