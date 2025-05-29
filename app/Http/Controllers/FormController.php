<?php
namespace App\Http\Controllers;

use App\Models\user_form_tokens;
class FormController extends Controller
{
    public function index($token)
    {
        $tokenEntry = user_form_tokens::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();
        return view('form.index');
    }

    public function submitForm($token)
    {
        $tokenEntry = user_form_tokens::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
?>