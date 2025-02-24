<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OccasionDataField;
use Illuminate\Support\Facades\Validator;

use App\Models\OccasionType;
use Session;


class OccasionDataFieldController extends Controller
{
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Occasion Type Data Field";
        $pageroot = "Settings";
        $occasions = OccasionType::where('delete_status', 0)->get();
        $query = OccasionDataField::query();

        // Filtering by occasion type
        if ($request->has('occasion') && $request->occasion != '') {
            $query->where('occasion_id', $request->occasion);
        }

        // Searching by data field name
        if ($request->has('search') && $request->search != '') {
            $query->where('datafieldname', 'like', '%' . $request->search . '%');
        }

        // Sorting by data field name (asc or desc)
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('datafieldname', $request->sort);
        }

        $occasionDataFields = $query->where('delete_status', 0)->paginate(20);
        return view('admin.occasiondatafields.index', compact('occasionDataFields','username','pagetitle','pageroot','occasions'));
    }
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Occasion Type Data Field";
        $occasionTypes = OccasionType::where('delete_status', 0)->get();
        return view('admin.occasiondatafields.create', compact('pagetitle', 'pageroot', 'username', 'occasionTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datafieldname' => 'required|string|max:255',
            'datafieldtype' => 'required|string|max:255',
            'occasion_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $occasionDataField = new OccasionDataField();
            $occasionDataField->datafieldname = $request->input('datafieldname');
            $occasionDataField->datafieldtype = $request->input('datafieldtype');
            $occasionDataField->occasion_id = $request->input('occasion_id');
            $occasionDataField->status = 'Active';
            $occasionDataField->delete_status = 0;
            $occasionDataField->save();
            return redirect('admin/occasiondatafield')->with('success', 'Occasion data field created successfully.');
        } catch (\Exception $e) {
            return redirect('admin/occasiondatafield')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Edit Occasion Type Data Field";
        $occasionDataField = OccasionDataField::findOrFail($id);
        $occasionTypes = OccasionType::where('delete_status', 0)->get();
        return view('admin.occasiondatafields.edit', compact('occasionDataField', 'pagetitle', 'pageroot', 'username', 'occasionTypes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'datafieldname' => 'required|string|max:255',
            'datafieldtype' => 'required|string|max:255',
            'occasion_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $occasionDataField = OccasionDataField::findOrFail($id);
            $occasionDataField->datafieldname = $request->input('datafieldname');
            $occasionDataField->datafieldtype = $request->input('datafieldtype');
            $occasionDataField->occasion_id = $request->input('occasion_id');
            $occasionDataField->status = $request->input('status', 'Active');
            $occasionDataField->delete_status = $request->input('delete_status', 0);
            $occasionDataField->save();
            return redirect('admin/occasiondatafield')->with('success', 'Occasion data field updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/occasiondatafield')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $occasionDataField = OccasionDataField::find($id);
            $occasionDataField->delete_status = 1;
            $occasionDataField->save();
            return redirect('admin/occasiondatafield')->with('success', 'Occasion Data Field deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/occasiondatafield')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $occasionDataField = OccasionDataField::find($id);
        if (!$occasionDataField) {
            return redirect('admin/occasiondatafield')->with('error', 'Occasion Data Field not found.');
        }
        $occasionDataField->status = ($occasionDataField->status === 'Active') ? 'Inactive' : 'Active';
        $occasionDataField->save();

        return redirect('admin/occasiondatafield')->with('success', 'Occasion Data Field status successfully updated.');
    }

}
