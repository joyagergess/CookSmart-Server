<?php 
namespace App\Services;

use App\Models\Expense;

class ExpenseService
{
    public static function list($household_id)
    {
        return Expense::where('household_id', $household_id)
            ->orderBy('date', 'desc')
            ->get();
    }

    public static function addOrUpdate($data, $id = "add")
    {
        $expense = $id === "add"
            ? new Expense
            : Expense::find($id);

        if (!$expense) return null;

        $expense->household_id = $data['household_id'];
        $expense->amount = $data['amount'];
        $expense->date = $data['date'];
        $expense->store = $data['store'];

        if (isset($data['receipt_url'])) {
            $expense->receipt_url = $data['receipt_url'];
        }

        $expense->save();
        return $expense;
    }

    public static function delete($id)
    {
        $expense = Expense::find($id);
        if (!$expense) return null;

        return $expense->delete();
    }

    public static function listByWeek($household_id, $week_start)
    {
        $start = date($week_start);
        $end = date('Y-m-d', strtotime($start . ' +6 days'));

        return Expense::where('household_id', $household_id)
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'asc')
            ->get();
    }
}
