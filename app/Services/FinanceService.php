<?php
namespace App\Services;

use App\Repositories\FinanceRepository;
use Carbon\Carbon;

class FinanceService
{
    protected $financeRepository;

    public function __construct(FinanceRepository $financeRepository) {
        $this->financeRepository = $financeRepository;
    }

    public function createEntry(array $data) {
        return $this->financeRepository->create($data);
    }

    public function getEntry($id) {
        return $this->financeRepository->find($id);
    }

    public function updateEntry(array $data, $id) {
        return $this->financeRepository->update($data, $id);
    }

    public function deleteEntry($id) {
        return $this->financeRepository->delete($id);
    }

    public function calculateBalance($startDate, $endDate) {
        return $this->financeRepository->calculateBalance($startDate, $endDate);
    }

    public function getExpensesSummaryByCategory($startDate, $endDate, $category) {
        return $this->financeRepository->getExpenseSummaryByCategory($startDate, $endDate, $category);
    }
    public function getAllEntries($filters = [], $perPage = 10)
    {
        return $this->financeRepository->getAll($filters, $perPage);
    }
}
