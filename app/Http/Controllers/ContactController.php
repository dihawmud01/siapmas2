<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        return view('users.contact', compact('user'));
    }

    public function store(Request $request)
    {
        $contact = $request->all();
        Contact::create($contact);

        Alert::success('Terima Kasih', 'Masukan anda sangat berharga bagi kami, chuaaaks');

        return redirect()->route('contact.create');
    }
}
