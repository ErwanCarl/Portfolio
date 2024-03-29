<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

class PaginationHandler 
{
    public function pagination(int $page, float $pageNumber) : int 
    {
        if($page > 0 && $page <= $pageNumber) {
            $currentPage = $page;
            return $currentPage;
        }else{
            $currentPage = 1;
            return $currentPage;
        }
    }
}
