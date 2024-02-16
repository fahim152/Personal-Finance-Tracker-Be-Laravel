<?php
namespace App\Http\Controllers;

use App\Http\Requests\CalculateFinanceEntryRequest;
use App\Http\Requests\CreateFinanceEntryRequest;
use App\Http\Requests\ExpensesSummaryRequest;
use App\Http\Requests\GetAllFinanceEntriesRequest;
use App\Http\Requests\UpdateFinanceEntryRequest;
use App\Services\FinanceService;

class FinanceController extends Controller
{
    protected $financeService;

    public function __construct(FinanceService $financeService)
    {
        $this->financeService = $financeService;
    }

    public function createEntry(CreateFinanceEntryRequest $request)
    {
        $entry = $this->financeService->createEntry($request->all());
        return response()->json($entry, 201);
    }

    public function readEntry($id)
    {
        $entry = $this->financeService->getEntry($id);
        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
        return response()->json($entry);
    }

    public function updateEntry(UpdateFinanceEntryRequest $request, $id)
    {
        $entry = $this->financeService->updateEntry($request->all(), $id);
        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
        return response()->json($entry);
    }

    public function deleteEntry($id)
    {
        $deleted = $this->financeService->deleteEntry($id);
        if (!$deleted) {
            return response()->json(['message' => 'Entry not found or could not be deleted'], 404);
        }
        return response()->json(['message' => 'Entry deleted successfully']);
    }

    public function calculateBalance(CalculateFinanceEntryRequest $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $balance = $this->financeService->calculateBalance($startDate, $endDate);
        return response()->json(['balance' => $balance]);
    }

    public function expensesSummary(ExpensesSummaryRequest $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $category = $request->category;
        $summary = $this->financeService->getExpensesSummaryByCategory($startDate, $endDate, $category);
        return response()->json($summary);
    }
    public function getAllEntries(GetAllFinanceEntriesRequest $request)
    {
        $filters = $request->only(['date', 'category']);
        $perPage = $request->input('per_page', 10);

        $entries = $this->financeService->getAllEntries($filters, $perPage);
        return response()->json($entries);
    }
}
