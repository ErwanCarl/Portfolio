<?php 

namespace App\entity;

Class Entity
{

    public function __construct(array $data = []) 
    {
        if(!empty($data)) {
            $this->hydrate($data);
        }
    }

    // to transform snake cae from BDD to Camel case functions from entities

    public function snakeToCamel(string $input) : string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public function hydrate(array $data) : void
    {
        foreach($data as $key => $value)
        {
            $method = 'set_'.$key;
            $transformedMethod = $this->snakeToCamel($method);
            if(method_exists($this, $transformedMethod))
            {
                $this->$transformedMethod($value);
            }
        }
    }
}
