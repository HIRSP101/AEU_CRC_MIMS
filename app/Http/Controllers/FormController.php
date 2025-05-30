<?php
namespace App\Http\Controllers;

use App\Models\form_submits;
class FormController extends Controller
{
    public function index($token)
    {
        $tokenEntry = form_submits::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();
        return view('form.index');
    }

    public function submitForm($token)
    {
        $tokenEntry = form_submits::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
?>