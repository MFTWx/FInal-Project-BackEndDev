<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvoiceHeader;
use App\Models\Toy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    public function index() // home
    {
        $toys = Toy::all();
        return view('index', compact('toys'));
    }

    public function product() // product page
    {
        $toys = Toy::paginate(12);
        $categories = Category::all();
        
        return view('toys.index', compact(['toys', 'categories']));
    }

    public function detail(Toy $toy) // detail page
    {
        $toys = Toy::all();
        $categories = Category::all();
        return view('toys.detail', compact(['toy', 'toys', 'categories']));
    }

    public function login() //login
    {
        return view('auth.login');
    }

    public function register() //register
    {
        return view('auth.register');
    }

    public function administration() //admin page
    {
        $toys = Toy::all();
        $categories = Category::all();
        return view('admin.index', compact(['toys', 'categories']));
    }

    public function filter(Category $category) // filter repo for admin
    {
        if ($category->id)
            $toys = Toy::where("category_id", $category->id)->get();
        else
            $toys = Toy::all();
        $categories = Category::all();
        return view('admin.index', compact(['toys', 'categories']));
    }

    public function filter_product(Category $category) // filter repo for product
    {
        if ($category->id)
            $toys = Toy::where("category_id", $category->id)->paginate(12);
        else
            $toys = Toy::paginate(12);
        $categories = Category::all();
        return view('toys.index', compact(['toys', 'categories']));
    }
    
    public function admin_search(Request $request) // repo search for admin
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');
        $toys = Toy::where("name", "like", "%$keyword%")->get();
        return view('admin.index', compact(['toys', 'categories']));
    }

    public function search(Request $request) // repo search for user
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');
        $toys = Toy::where("name", "like", "%$keyword%")->paginate(12);
        return view('toys.index', compact(['toys', 'categories']));
    }

    public function userLogin(Request $request) // repo login
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            
            $request->session()->regenerate();

            if (Auth::user()->role == "user") {
                return redirect()->route('home');
            }
            
            return redirect()->route('admin.home');
        }
        return redirect()->back()->withErrors([
            'error' => 'Invalid Credentials!'
        ]);

    }

    public function userRegister(Request $request) // repo register
    {

        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'password' => 'required|confirmed',
        ]);

        $role = $validatedData['email'] === 'admin@gmail.com' ? 'admin' : 'user'; // pembagian role untuk admin dan user berdasarkan email

        User::create([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'contact' => $validatedData['contact'],
            'address' => $validatedData['address'],
            'birthday' => $validatedData['birthday'],
            'password' => $validatedData['password'],
            'role' => $role,
            'money' => '1000000'
        ]);

        return redirect()->route('user.login');
    }

    public function userAccount() // repo redirect account
    {
        $userId = auth()->id();
        $invoiceCount = InvoiceHeader::where('user_id', $userId)->count();
        return view('account.index', compact('invoiceCount'));
    }

    public function userTopup() // repo redirect topup
    {
        return view('account.topup');
    }

    public function userAddBalance(Request $request) // repo add balance
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'amount' => 'required|numeric|min:1000',
            'password' => 'required',
        ]);

        $hashedPassword = $user->password;

        if (Hash::check($request->password, $hashedPassword)) {
            $user->money += $validatedData['amount'];
            $user->save();
            return redirect()->route('user.topup');
        }
        else
        {
            return redirect()->back()->withErrors([
                'error' => 'Invalid Password!'
            ]);    
        }
    }

    public function userReduceBalance($reduce) // repo reducing balance
    {
        $user = Auth::user();
        $user->money -= $reduce;
        $user->save();
        return redirect()->route('home');
    }

    public function logout(Request $request) // repo logout
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

}
