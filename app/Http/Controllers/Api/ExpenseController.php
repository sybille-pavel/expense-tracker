<?php

    namespace App\Http\Controllers\Api;

    use App\Models\Expense;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreExpenseRequest;
    use App\Http\Requests\UpdateExpenseRequest;
    use App\Http\Resources\ExpenseResource;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;

    class ExpenseController extends Controller
    {
        use AuthorizesRequests;
        public function index(Request $request)
        {
            $expenses = Expense::where('user_id', $request->user()->id)
                ->orderByDesc('date')
                ->get();

            return ExpenseResource::collection($expenses)->resolve();
        }

        public function store(StoreExpenseRequest $request)
        {
            $expense = Expense::create([
                ...$request->validated(),
                'user_id' => $request->user()->id,
            ]);

            return new ExpenseResource($expense);
        }

        public function update(UpdateExpenseRequest $request, Expense $expense)
        {
            $this->authorize('update', $expense);
            $expense->update($request->validated());

            return new ExpenseResource($expense);
        }

        public function destroy(Expense $expense)
        {
            $this->authorize('delete', $expense);
            $expense->delete();

            return response()->noContent();
        }
    }
