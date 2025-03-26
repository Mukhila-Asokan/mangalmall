<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOccasion;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Models\BudgetCategory;
use Modules\Settings\Models\BudgetCatAssignEvent;
Use Modules\Settings\Models\BudgetItems;
use App\Models\UserBudget;


class UserBudgetController extends Controller
{
    public function index()
    {
        try {
            $userid = Auth::user()->id;  
            $userOccasion = userOccasion::where('delete_status', 0)
            ->where('userid', $userid)
            ->get();


            $budgetStats = [];
    
        foreach ($userOccasion as $occasion) {
            $totalBudget = UserBudget::where('delete_status', 0)->where('useroccasion_id', $occasion->id)->sum('planned_amount');
            $actualAmount = UserBudget::where('delete_status', 0)->where('useroccasion_id', $occasion->id)->sum('completed_amount');
            $remainingAmount = $totalBudget - $actualAmount;
    
            $budgetStats[$occasion->id] = [
                'total_budget' => $totalBudget,
                'planned_budget' => $totalBudget,  // Planned amount = Total budget
                'actual_budget' => $actualAmount,
                'remaining_budget' => $remainingAmount
            ];
        }

           
            return view('userbudget.index', compact('userOccasion', 'budgetStats'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Please log in to access the user budget.']);
        }


    }      
    
        public function create($id)
        {
            try {
                $userid = Auth::user()->id;
                
                $userOccasion = UserOccasion::where('id', $id)->where('userid',$userid)->first();
                

                $budgetcatIds = BudgetCatAssignEvent::where('occasion_id',$userOccasion->occasiontypeid)->pluck('category_id');
               
         
                $budgettitems = BudgetItems::whereIn('budget_category_id', $budgetcatIds)->get();
            
    
                foreach ($budgettitems as $listitem) {

                   

                    $existingBudget = UserBudget::where('name', $listitem->name)
                        ->where('user_id', $userid)
                        ->where('useroccasion_id', $id)
                        ->first();


                       
                if (!$existingBudget) { 
                    $userBudget = new UserBudget();
                    $userBudget->name = $listitem->name;
                    $userBudget->user_id = $userid;
                    $userBudget->useroccasion_id = $id;
                    $userBudget->planned_amount = 0; // Default value
                    $userBudget->completed_amount = 0; // Default value
                    $userBudget->description = $listitem->name;
                    $userBudget->status = 'Active';
                    $userBudget->delete_status = 0;
                    $userBudget->save();
                }
            }
                $budget = UserBudget::where('user_id', $userid)
                    ->where('delete_status', 0)
                    ->where('useroccasion_id', $id)
                    ->get();

                $planned_amount = UserBudget::where('user_id', $userid)
                    ->where('delete_status', 0)
                    ->where('useroccasion_id', $id)
                    ->sum('planned_amount');

                $completed_amount = UserBudget::where('user_id', $userid)
                    ->where('delete_status', 0)
                    ->where('useroccasion_id', $id)
                    ->sum('completed_amount');  

                return view('userbudget.create', compact('userOccasion', 'budget','planned_amount','completed_amount'));    

            } catch (\Exception $e) {
                dd($e);
                return redirect()->route('home')->with('error', 'Session expired, please log in again.');
            }
        }


        public function update(Request $request)
        {
            $budget = UserBudget::find($request->id);

            if ($budget) {
                $budget->planned_amount = $request->planned_amount;
                $budget->completed_amount = $request->completed_amount;
                $budget->save();

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false], 404);
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'planned_amount' => 'required',
                'useroccasion_id' => 'required|integer'
            ]);

           
            $userid = Auth::user()->id;
            $userBudget = new UserBudget();
            $userBudget->name = $validatedData['name'];
            $userBudget->user_id = $userid;
            $userBudget->useroccasion_id = $validatedData['useroccasion_id'];
            $userBudget->planned_amount = $validatedData['planned_amount']; // Default value
            $userBudget->completed_amount = 0; // Default value
            $userBudget->description = $validatedData['name'];
            $userBudget->status = 'Active';
            $userBudget->delete_status = 0;
            $userBudget->save();

            if ($userBudget) {
                return response()->json([
                    'success' => true,
                    'budget' => $userBudget
                ]);
            }

            return response()->json(['success' => false]);
        }

        public function destroy($id)
        {
            $budget = UserBudget::find($id);

            if ($budget) {
                $budget->delete_status = 1;
                $budget->save();

                return response()->json([
                    'success' => true
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Budget item not found.'
            ]);
        }



}
