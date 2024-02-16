<?php
namespace App\Interfaces;

interface FinanceRepositoryInterface
{
    public function create(array $data);
    public function find($id);
    public function update(array $data, $id);
    public function delete($id);
    public function calculateBalance($startDate, $endDate);
    public function getExpenseSummaryByCategory($startDate, $endDate, $category);
    public function getAll($filters = [], $perPage = 10);
}
