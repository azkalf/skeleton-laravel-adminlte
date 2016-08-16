<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use App\Company;
use Validator;
use Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('config.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|alpha_dash',
            'fullname' => 'required|max:255',
            'sex' => 'required',
            'email' => 'required|email',
            'photo' => 'image',
        ]);

        if ($request['email'] != $user->email) {
            if (User::where('email', $request['email'])) {
                $validator->after(function($validator) {
                    $validator->errors()->add('email', 'These email has already been taken.');
                });
            }
        }

        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('profile')
                            ->withErrors($validator)
                            ->withInput();
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destination = base_path().'/public/images/';
            $filename = 'photo_'.$user->name.'.'.$photo->getClientOriginalExtension();
            if ($photo->isValid()) {
                unlink($destination.$user->photo);
                $photo->move($destination, $filename);
            } else {
                $validator->after(function($validator) {
                    $validator->errors()->add('photo', 'There is error with image file.');
                });
            }
        }
        $user->update([
            'name' => $request['name'],
            'fullname' => $request['fullname'],
            'sex' => $request['sex'],
            'email' => $request['email'],
            'photo' => isset($filename) ? $filename : $user->photo,
        ]);
        session()->flash('success', 'Profile has successfully updated.');
        
        return redirect('profile');
    }

    public function changePassword()
    {
        $user = User::find(Auth::user()->id);
        return view('config.changePassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        Validator::extend('old_password', function($attribute, $value, $parameters, $validator) {
            if (Hash::check($value, current($parameters))) {
                return true;
            } else {
                $validator->errors()->add('old_password', 'These credentials do not match our records.');
            }
        });

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|old_password:'.Auth::user()->password,
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('changePassword')
                            ->withErrors($validator)
                            ->withInput();
        }

        $user = User::find($id);
        $user->password = bcrypt($request['password']);
        $user->save();
        session()->flash('success', 'Password has successfully changed.');
        
        return redirect('changePassword');
    }

    public function companySetting()
    {
        if (!isset(Auth::user()->company_id))
            return abort(503);

        $company = Company::find(Auth::user()->company_id);
        return view('config.company', compact('company'));
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::find($id);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'company_shortname' => 'alpha_dash',
            'company_email' => 'required|email',
            'company_address' => 'required|max:255',
            'company_logo' => 'image',
        ]);

        if ($request['company_email'] != $company->company_email) {
            if (Company::where('company_email', $request['company_email'])) {
                $validator->after(function($validator) {
                    $validator->errors()->add('company_email', 'The email has already been taken.');
                });
            }
        }

        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('company')
                            ->withErrors($validator)
                            ->withInput();
        }

        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $destination = base_path().'/public/images/';
            $filename = 'logo_'.$company->name.'.'.$logo->getClientOriginalExtension();
            if ($logo->isValid()) {
                unlink($destination.$company->logo);
                $logo->move($destination, $filename);
            } else {
                $validator->after(function($validator) {
                    $validator->errors()->add('company_logo', 'There is error with image file.');
                });
            }
        }
        $company->update([
            'company_name' => $request['company_name'],
            'company_shortname' => $request['company_shortname'],
            'company_address' => $request['company_address'],
            'company_phone' => $request['company_phone'],
            'company_fax' => $request['company_fax'],
            'company_pic' => $request['company_pic'],
            'company_email' => $request['company_email'],
            'company_homepage' => $request['company_homepage'],
            'company_logo' => isset($filename) ? $filename : $company->photo,
        ]);
        session()->flash('success', 'Company has successfully updated.');
        
        return redirect('company');
    }
}
