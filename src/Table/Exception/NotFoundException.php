<?php 
namespace App\Table\Exception;

class NotFoundException extends \Exception 
{
    public function __construct(string $table, $id)
    {
        $this->message = "No registration matches the ID #$id in table $table";
    }
}