<?php
namespace App\Repositories;

use App\Constants\CategoryConstants;
use App\Interfaces\FinanceRepositoryInterface;
use App\Models\FinanceEntry;
use Illuminate\Support\Facades\DB;

class FinanceRepository implements FinanceRepositoryInterface
{
    public function create(array $data) {
        return FinanceEntry::create($data);
    }

    public function find($id) {
        return FinanceEntry::find($id);
    }

    public function update(array $data, $id) {
        $entry = FinanceEntry::find($id);
        if ($entry) {
            $entry->update($data);
            return $entry;
        }
        return null;
    }

    public function delete($id) {
        $entry = FinanceEntry::find($id);
        if ($entry) {
            $entry->delete();
            return true;
        }
        return false;
    }

    public function calculateBalance($startDate, $endDate) {
        $income = FinanceEntry::whereBetween('date', [$startDate, $endDate])
            ->where('category', CategoryConstants::INCOME)
            ->sum('amount');

        $expenses = FinanceEntry::whereBetween('date', [$startDate, $endDate])
            ->where('category', CategoryConstants::EXPENSE)
            ->sum('amount');
        return $income - $expenses;
    }

    public function getExpenseSummaryByCategory($startDate, $endDate, $category) {
        return FinanceEntry::select('category', DB::raw('SUM(amount) as total'))
                    ->whereBetween('date', [$startDate, $endDate])
                    ->where('category', '=', $category)
                    ->groupBy('category')
                    ->get();
    }
    public function getAll($filters = [], $perPage = 10)
    {
        $query = FinanceEntry::query();

        // Apply filters if any
        if (!empty($filters)) {
            if (isset($filters['date'])) {
                $query->whereDate('date', '=', $filters['date']);
            }
            if (isset($filters['category'])) {
                $query->where('category', '=', $filters['category']);
            }
            // Add more filters as needed
        }

        return $query->paginate($perPage);
    }
}
