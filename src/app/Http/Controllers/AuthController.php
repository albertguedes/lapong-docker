<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return redirect()->with('danger', 'Email ou senha erradas')->route('auth.login');
    }

    public function register(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $customer = Customer::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => false
        ]);

        if(! $customer) {
            return redirect()->with('danger', 'Não foi possível realizar cadastrar')->route('auth.fail');
        }

        return redirect()->with('success', 'Cadastro realizado com sucesso')->route('auth.success');
    }

    public function recover(): View
    {
        return view('auth.recover');
    }

    public function request(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        return redirect()->route('auth.login');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }

    public function success(Request $request): View
    {
        $title = $request->input('title');
        $content = $request->input('content');

        return view('auth.success',compact('title', 'content'));
    }

    public function fail(Request $request): View
    {
        $title = $request->input('title');
        $content = $request->input('content');

        return view('auth.fail',compact('title', 'content'));
    }
}
