<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;   
use App\Models\Page;   
use App\Models\Menuitem;    
use App\Models\Team;   
use App\Models\Testimonial;   
use App\Models\Setting;   
use App\Models\Menu;   
use App\Models\Slider;   
use App\Models\About;     
use App\Models\User;  
use App\Models\Admin;  
use App\Models\Client;  
use App\Models\Agent;  
use App\Models\Supplier;  
use App\Models\Passport;  
use App\Models\Invoice;  
use App\Models\Refund;  
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle    = 'Dashboard';
        $sections     = Section::latest()->get();   
        $pages        = Page::latest()->get();   
        $menuitems    = Menuitem::latest()->get();   
        $teams        = Team::latest()->get();   
        $testimonials = Testimonial::latest()->get();   
        $settings     = Setting::latest()->get();   
        $menus        = Menu::latest()->get();   
        $sliders      = Slider::latest()->get();   
        $abouts       = About::latest()->get();   

        $supplier      = Supplier::all();
        $passport      = Passport::all();
        $invoice      = Invoice::all();
        $refund      = Refund::all();
        $agents      = Agent::all();
        $totalAgents = $agents->count();
        $clients      = Client::all();
        // Calculate totals
        $totalClients = $clients->count();
        $totalAmount = $clients->sum('total_amount');
        $totalRefund = $clients->sum('total_refund');
        $netBalance = $totalAmount - $totalRefund;

        // Check if the public/storage symlink exists
        if (!File::exists(public_path('storage'))) {
            // Create the symlink
            app('files')->link(storage_path('app/public'), public_path('storage'));
        }

        return view('admin.dashboard.index', compact('pageTitle', 'sections', 'pages','menuitems','menus','testimonials','teams','sections','settings','sliders','abouts',  'clients',
        'totalClients',
        'totalAmount',
        'totalRefund',
        'netBalance',
        'totalAgents',
        'supplier',
        'passport',
        'invoice',
        'refund',
        ));
    }
}
