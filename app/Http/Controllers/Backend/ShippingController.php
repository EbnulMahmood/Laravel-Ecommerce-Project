<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\State;
use Carbon\Carbon;

class ShippingController extends Controller
{
    public function ManageDivision()
    {
        $divisions = Division::orderBy('id', 'DESC')->get();
        return view('backend.shipping.division.division_view', compact('divisions'));
    }

    public function StoreDivision(Request $request)
    {
        $request->validate([
            'division_name' => 'required',
        ]);

        Division::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('Division inserted successfully!', 'success');

        return Redirect()->back()->with($notification);
    }

    public function DivisionEdit($id)
    {
        $division = Division::findOrFail($id);
        return view('backend.shipping.division.division_edit', compact('division'));
    }

    public function DivisionUpdate(Request $request, $id)
    {
        Division::findOrFail($id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = AlertMessage('Division updated successfully!', 'success');
        
        return Redirect()->route('manage.division')->with($notification);
    }

    public function DivisionDelete($id)
    {
        Division::findOrFail($id)->delete();
        $notification = AlertMessage('Division deleted successfully!', 'success');
        
        return Redirect()->route('manage.division')->with($notification);
    }


    public function ManageDistrict()
    {
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $districts = District::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.shipping.district.district_view', compact('districts', 'divisions'));
    }

    public function StoreDistrict(Request $request)
    {
        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ]);

        District::insert([
            'district_name' => $request->district_name,
            'division_id' => $request->division_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('District inserted successfully!', 'success');

        return Redirect()->back()->with($notification);
    }

    public function DistrictEdit($id)
    {
        $district = District::findOrFail($id);
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        return view('backend.shipping.district.district_edit', compact('district', 'divisions'));
    }

    public function DistrictUpdate(Request $request, $id)
    {
        District::findOrFail($id)->update([
            'district_name' => $request->district_name,
            'division_id' => $request->division_id,
        ]);

        $notification = AlertMessage('District updated successfully!', 'success');
        
        return Redirect()->route('manage.district')->with($notification);
    }

    public function DistrictDelete($id)
    {
        District::findOrFail($id)->delete();
        $notification = AlertMessage('District deleted successfully!', 'success');
        
        return Redirect()->route('manage.district')->with($notification);
    }


    public function ManageState()
    {
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $states = State::with('division')->with('district')->orderBy('id', 'DESC')->get();
        return view('backend.shipping.state.state_view', compact('states', 'divisions'));
    }

    public function GetDistrictAJAX($division_id)
    {
        $districts = District::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    }

    public function StoreState(Request $request)
    {
        $request->validate([
            'state_name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
        ]);

        State::insert([
            'state_name' => $request->state_name,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('State inserted successfully!', 'success');

        return Redirect()->back()->with($notification);
    }

    public function StateEdit($id)
    {
        $state = State::findOrFail($id);
        $divisions = Division::orderBy('division_name', 'ASC')->get();
        $districts = District::orderBy('district_name', 'ASC')->get();
        return view('backend.shipping.state.state_edit', compact('districts', 'divisions', 'state'));
    }

    public function StateUpdate(Request $request, $id)
    {
        State::findOrFail($id)->update([
            'state_name' => $request->state_name,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
        ]);

        $notification = AlertMessage('State updated successfully!', 'success');
        
        return Redirect()->route('manage.state')->with($notification);
    }

    public function StateDelete($id)
    {
        State::findOrFail($id)->delete();
        $notification = AlertMessage('State deleted successfully!', 'success');
        
        return Redirect()->route('manage.state')->with($notification);
    }
}
