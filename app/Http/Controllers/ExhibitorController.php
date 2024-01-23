<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibitor;
use App\Models\Membership;
use App\Models\Attendee;
use App\Models\State;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Mail\FormSubmitted;
use Illuminate\Support\Facades\Mail;

class ExhibitorController extends Controller
{

    // load view page of index
    public function index()
    {
        return view("frontend.index");
    }


    // LOAD VIEW PAGE EXHIBITOR_REGISTRATION
    public function exhibitor_registration()
    {
        $states = State::pluck('name', 'id');
        return view("frontend.exhibitor_registration", compact('states'));
    }

    public function validate_exhibitor(Request $request)
    {
        $data = $request->all();
        $request->validate([

            'company_name'     => 'required|string|max:255',
            'contact_name'     => 'required|string|max:255',
            'contact_email'    => 'required|email|unique:tbl_exhibitor,contact_email|max:255',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'phone_number'     => 'required|numeric|digits:10',
            'zip_code'         => 'required|string|min:6'
            // 'electricity_required' => 'required|array',
            // 'electricity_required.*' => 'required|in:yes,no',
        ]);
        // dd($request->all());

        $exhibitorId = 'E' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        // Check if the generated exhibitor_id already exists in the database
        while (Exhibitor::where('exhibitor_id', $exhibitorId)->exists()) {
            // Regenerate if it exists
            $exhibitorId =  'E' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        $electricity = implode(',', $data['electricity']);

        Exhibitor::create([
            'exhibitor_id' =>  $exhibitorId,
            'company_name' =>  $data['company_name'],
            'contact_name' =>  $data['contact_name'],
            'contact_email' =>  $data['contact_email'],
            'address'      =>  $data['address'],
            'city'         =>  $data['city'],
            'state'        =>  $data['state'],
            'phone_number' =>  $data['phone_number'],
            'zip_code'     =>  $data['zip_code'],
            'electricity_required'     =>  $electricity,
        ]);
        // $email = Mail::to($request->input('contact_email'))->send(new FormSubmitted);

        return redirect('exhibitor_registration')->with('success', 'Exhibitor Registration Completed');
    }

    public function exhibitor_table(Request $request)
    {
        if ($request->ajax()) {
            $data = Exhibitor::latest();

             // Apply filter if company name is provided
             if ($request->has('company_name')) {
                $data->where('company_name', 'like', '%' . $request->input('company_name') . '%');
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editExhibitor">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteExhibitor">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.exhibitor_table');
    }

    // function for exporting exhibitor_registration tbl
    // public function exportExhibitorCsv()
    // {
    //     // Fetch data from the table
    //     $exhibitors = Exhibitor::select('id', 'exhibitor_id', 'contact_name', 'company_name', 'contact_email', 'address', 'city', 'state', 'phone_number', 'zip_code', 'electricity_required')->get();

    //     // Create a CSV file
    //     $csvFileName = 'exhibitors.csv';
    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$csvFileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0",
    //     );

    //     $csvContent = function () use ($exhibitors) {

    //         // Create a CSV file in memory
    //         $handle = fopen('php://output', 'w');

    //         // Add headers to the CSV file
    //         fputcsv($handle, array_keys($exhibitors->first()->toArray()));

    //         // Add data to the CSV file
    //         foreach ($exhibitors as $exhibitor) {
    //             fputcsv($handle, $exhibitor->toArray());
    //         }

    //         // // Move the pointer back to the start of the file
    //         // fseek($handle,0);

    //         // // Generate a response with the CSV file
    //         // $response = Response::make(stream_get_contents($handle), 200, $headers);

    //         // Close the file handle
    //         fclose($handle);

    //         // return $response
    //     };

    //     // Create a stream response with the CSV content
    //     return Response::stream($csvContent, 200, $headers);
    // }

    public function exportExhibitorCsv(Request $request)
    {
        // Fetch filter parameters from the request
        $companyName = $request->input('company_name');

        // Build the query with filters
        $query = Exhibitor::select('id', 'exhibitor_id', 'contact_name', 'company_name', 'contact_email', 'address', 'city', 'state', 'phone_number', 'zip_code', 'electricity_required');

        // Apply filters
        if ($companyName) {
            $query->where('company_name', 'like', '%' . $companyName . '%');
        }

        // Fetch data from the table
        $exhibitors = $query->get();

        // Create a CSV file
        $csvFileName = 'exhibitors.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $csvContent = function () use ($exhibitors) {

            // Create a CSV file in memory
            $handle = fopen('php://output', 'w');

            // Add headers to the CSV file
            fputcsv($handle, array_keys($exhibitors->first()->toArray()));

            // Add data to the CSV file
            foreach ($exhibitors as $exhibitor) {
                fputcsv($handle, $exhibitor->toArray());
            }

            fclose($handle);
        };

        // Create a stream response with the CSV content
        return Response::stream($csvContent, 200, $headers);
    }

    // LOAD VIEW PAGE ASSIGN_REGISTRATION
    public function assign_membership()
    {
        return view("frontend.assign_membership");
    }

    public function validate_membership(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $request->validate([

            'membership_type'      => 'required|in:retailer_membership,supplier_membership,manufacturer_membership',
            'corporation_name'     => 'required|string|max:255',
            'bussiness_name'       => 'required|string|max:255',
            'contact_person_name'  => 'required|string|max:255',
            'email_id'             => 'required|email|unique:tbl_membership,email_id|max:255',
            'phone_number'         => 'required|numeric|digits:10',
            'bussiness_address'    => 'required',

        ]);
        // $prefix = 'R';
        // $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        // $membershipId = $prefix . $randomNumber;
        // dd($request->all());
        $retailMembershipId = ('R' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        $supplierMembershipId = ('V' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        $manufacturerMembershipId = ('M' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        if ($data['membership_type'] == 'retailer_membership') {
            $membershipId = $retailMembershipId;
        } elseif ($data['membership_type'] == 'supplier_membership') {
            $membershipId = $supplierMembershipId;
        } elseif ($data['membership_type'] == 'manufacturer_membership') {
            $membershipId = $manufacturerMembershipId;
        }
        // dd($membershipId);

        // Check if the generated exhibitor_id already exists in the database
        // while (Membership::where('membership_id', $membershipId)->exists()) {
        //     // Regenerate if it exists
        //     $retail_membershipId =('R' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        // }

        Membership::create([
            'membership_id' =>  $membershipId,
            'corporation_name' =>  $data['corporation_name'],
            'bussiness_name' =>  $data['bussiness_name'],
            'contact_person_name' =>  $data['contact_person_name'],
            'email_id' =>  $data['email_id'],
            'phone_number' =>  $data['phone_number'],
            'bussiness_address'      =>  $data['bussiness_address'],

        ]);

        return redirect('assign_membership')->with('success', 'Assign Membership Registration Completed');
    }

    public function membership_table(Request $request)
    {
        if ($request->ajax()) {
            $data = Membership::latest();

            // Apply filter if bussiness name is provided
            if ($request->has('bussiness_name')) {
                $data->where('bussiness_name', 'like', '%' . $request->input('bussiness_name') . '%');
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editMembership">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteMembership">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.membership_table');
    }

    // function for exporting membership_registration tbl
    public function exportMembershipCsv(Request $request)
    {
        // Fetch filter parameters from the request
        $bussinessName = $request->input('bussiness_name');

        // Build the query with filters
        $query = Membership::select('id', 'membership_id', 'corporation_name', 'bussiness_name', 'contact_person_name', 'email_id', 'phone_number', 'bussiness_address');

        // Apply filters
        if ($bussinessName) {
            $query->where('bussiness_name', 'like', '%' . $bussinessName . '%');
        }

        // Fetch data from the table
        $memberships = $query->get();

        // Create a CSV file
        $csvFileName = 'membership.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $csvContent = function () use ($memberships) {

            // Create a CSV file in memory
            $handle = fopen('php://output', 'w');

            // Add headers to the CSV file
            fputcsv($handle, array_keys($memberships->first()->toArray()));

            // Add data to the CSV file
            foreach ($memberships as $membership) {
                fputcsv($handle, $membership->toArray());
            }

            fclose($handle);
        };

        // Create a stream response with the CSV content
        return Response::stream($csvContent, 200, $headers);
    }


    // LOAD VIEW PAGE ATTENDEE_REGISTRATION
    public function attendee_registration()
    {
        $states = State::pluck('name', 'id');
        return view('frontend.attendee_registration', compact('states'));
    }

    public function validate_attendee(Request $request)
    {
        $data = $request->all();
        $request->validate([

            'name'             => 'required|string',
            'company_name'     => 'required|string',
            'email'            => 'required|email',
            'phone_number'     => 'required|numeric|digits:10',
            'address'          => 'required',
            'city'             => 'required',
            // 'state'            => 'required',
            'zip_code'         => 'required|string|min:6',
            'attendee_name_2'  => 'required|string',
            'attendee_email_2' => 'required|email',
            'attendee_name_3'  => 'required|string',
            'attendee_email_3' => 'required|email',
            'attendee_name_4'  => 'required|string',
            'attendee_email_4' => 'required|email',
            'categories'       => ['required', 'array', Rule::in(['gas_station', 'c_store', 'liquor_store', 'smoke_vape_shop', 'other'])],
            'categories.*'     => 'in:yes',
        ]);

        // dd($data);
        $attendeeId = ('A' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        // Check if the generated exhibitor_id already exists in the database
        while (Attendee::where('attendee_id', $attendeeId)->exists()) {
            // Regenerate if it exists
            $attendeeId = ('A' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
        }
        // dd($attendeeId);

        $categoryString = implode(',', $data['categories']);
        // dd($categoryString);
        Attendee::create([
            'attendee_id'     =>  $attendeeId,
            'name'            =>  $data['name'],
            'company_name'    =>  $data['company_name'],
            'email'           =>  $data['email'],
            'phone_number'    =>  $data['phone_number'],
            'address'         =>  $data['address'],
            'city'            =>  $data['city'],
            'state'           =>  $data['state'],
            'zip_code'        =>  $data['zip_code'],
            'attendee_name_2' =>  $data['attendee_name_2'],
            'attendee_email_2' =>  $data['attendee_email_2'],
            'attendee_name_3' =>  $data['attendee_name_3'],
            'attendee_email_3' =>  $data['attendee_email_3'],
            'attendee_name_4' =>  $data['attendee_name_4'],
            'attendee_email_4' =>  $data['attendee_email_4'],
            'category' => $categoryString,
        ]);

        return redirect('attendee_registration')->with('success', 'Attendee Registration Completed');
    }

    public function attendee_table(Request $request)
    {
        if ($request->ajax()) {
            $data = Attendee::latest();
            // $data = Attendee::query();

            // Apply filter if company name is provided
            if ($request->has('company_name')) {
                $data->where('company_name', 'like', '%' . $request->input('company_name') . '%');
                // dd($data);
            }

            // Use DataTables helper for server-side processing
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editAttendee">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteAttendee">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.attendee_table');
    }

    public function exportAttendeeCsv(Request $request)
    {
        // Fetch filter parameters from the request
        $companyName = $request->input('company_name');

        // Build the query with filters
        $query = Attendee::select('id', 'attendee_id', 'name', 'company_name', 'email', 'phone_number', 'address', 'city', 'state', 'zip_code', 'attendee_name_2', 'attendee_email_2', 'attendee_name_3', 'attendee_email_3', 'attendee_name_4', 'attendee_email_4', 'category');

        // Apply filters
        if ($companyName) {
            $query->where('company_name', 'like', '%' . $companyName . '%');
        }

        // Fetch data from the table
        $attendees = $query->get();

        // Create a CSV file
        $csvFileName = 'attendees.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $csvContent = function () use ($attendees) {

            // Create a CSV file in memory
            $handle = fopen('php://output', 'w');

            // Add headers to the CSV file
            fputcsv($handle, array_keys($attendees->first()->toArray()));

            // Add data to the CSV file
            foreach ($attendees as $attendee) {
                fputcsv($handle, $attendee->toArray());
            }

            fclose($handle);
        };

        // Create a stream response with the CSV content
        return Response::stream($csvContent, 200, $headers);
    }


    //     public function exportAttendeeCsv(Request $request)
    // {
    //     $query = Attendee::query();

    //     // Apply filter if company name is provided
    //     if ($request->has('companyName')) {
    //         $query->where('company_name', 'like', '%' . $request->input('companyName') . '%');
    //     }

    //     $attendees = Attendee::select('id', 'attendee_id', 'name', 'company_name', 'email', 'phone_number', 'address', 'city', 'state', 'zip_code', 'attendee_name_2', 'attendee_email_2', 'attendee_name_3', 'attendee_email_3', 'attendee_name_4', 'attendee_email_4', 'category')->get();

    //     return Excel::download(new AttendeeExport($attendees), 'attendees.csv');
    // }
}
