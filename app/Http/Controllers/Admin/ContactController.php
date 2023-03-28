<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contacts::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:contacts',
            'phone_number' => 'required|numeric|min:10',
            'whatsApp'=>'required|numeric|min:10',
            'facebook'=>'url',
            'instagram'=>'url',
        ]);

        Contacts::create($request->all());

        return redirect()->route('contact.index')->with('success', 'Successfully Added');
    }

    public function edit($id)
    {
        $contact = Contacts::find($id);
        return view('admin.contact.edit', compact('contact'));
    }


    public function update(Request $request, $id)
    {
        $contact = Contacts::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:contacts,email,'.$id,
            'phone_number' => 'required|numeric|min:10',
            'whatsApp'=>'required|numeric|min:10',
            'facebook'=>'url',
            'instagram'=>'url',
        ]);

        $contact->update($request->all());

        return redirect()->route('contact.index')->with('success', 'Successfully Updated');
    }

    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Successfully Deleted');
    }
}
