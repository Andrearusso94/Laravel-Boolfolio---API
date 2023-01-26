<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class APILeadController extends Controller
{
    function store(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $new_lead = new Lead();
        $new_lead->name = $data['name'];
        $new_lead->email = $data['email'];
        $new_lead->message = $data['message'];
        $new_lead->save();

        Mail::to('admin@larevel.it')->send(new NewContact($new_lead));
        return response()->json([
            'success' => true

        ]);
    }
}
