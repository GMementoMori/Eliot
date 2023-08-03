<?php
namespace App\Model\Interface;

interface Model
{
    public function getBy(array $params): ?array;
}

