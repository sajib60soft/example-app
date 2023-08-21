<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;

class MapController extends Controller
{
    public function index()
    {
        return view('pages.map');
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('company_create'), 403);
        $company = Company::create($request->all());
        return redirect()->route('admin.companies.index');
    }
}
