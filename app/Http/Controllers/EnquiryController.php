<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enquiry;
use App\EnquiryType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{

    public function viewAdd(){
        $items = EnquiryType::all(['id', 'name']);

        return view('enquiries.add', compact('items', $items));
    }

    public function viewEnquiry($id){
        $enquiry = Enquiry::where('id','=',$id)
                            ->first();

        if(sizeof($enquiry) == 0){
            abort(404);
        };
        $customer = Customer::find($enquiry->user_id);
        $enquiry['customer'] = $customer;
        $items = EnquiryType::all(['id', 'name']);

        $data = ['enquiry' => $enquiry, 'items' => $items];

        return view('enquiries.enquiry')->with($data);
    }

    public function create(Request $request){

        $this->addRules($request->all())->validate();
        DB::beginTransaction();


        try {
            $enquiry = Enquiry::create([
                'name'            => $request->name,
                'description'     => $request->description,
                'status'          => 'Waiting For Quotation',
                'user_id'         => Auth::user()->id,
                'enquiry_type_id' => $request->type,
            ]);

            $enquiry->addMediaFromRequest('file')->toMediaCollection('enquiries');

            DB::commit();

            return redirect()->back()->with(['status' => 'Enquiry Added Successfully']);

        } catch (\Exception $e) {

            DB::rollback();

            Log::debug($e->getMessage());

            return redirect()->back()
                ->with(['status' => 'Document upload failed']);
        }


    }

    private function addRules(array $data){
        return Validator::make($data, [
            'name'             => 'required|string|max:255',
            'description'      => 'required|string',
            'type'             => 'required|numeric',
            'file_description' => 'string|max:255',
        ]);


    }

    public function update(Request $request){

        $this->addRules($request->all())->validate();
        $enquiry = Enquiry::find($request->id);

        //return $request->all();
        DB::beginTransaction();
        try {
            $enquiry->name = $request->name;
            $enquiry->enquiry_type_id = $request->type;
            $enquiry->description = $request->description;
            $enquiry->save();

            if($request->file){
                $enquiry->addMediaFromRequest('file')->toMediaCollection('enquiries');

            }


            DB::commit();

            return redirect()->back()->with(['status' => 'Enquiry Updated Successfully']);
        } catch (\Exception $e) {
            return $e;
            DB::rollback();

            Log::debug($e->getMessage());

            return redirect()->back()
                ->with(['status' => 'Error Occurred']);
        }


    }

    public function deleteMedia(Request $request){
        Enquiry::find($request->id)->deleteMedia($request->media_id);
        return redirect()->back()->with(['status' => 'File Deleted!']);

    }
}
