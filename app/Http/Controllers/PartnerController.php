<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $query = User::query()
            #->where('country', request()->user()->country)
            ->whereHas('partner', function ($query) {
                return $query->approved();
            });

        if (request()->ajax()) {
            return DataTables::of($query)->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            Column::make('photo')
                ->title('Photo')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    return `<img style="height: 36px; width: 36px;" src="`+this.profile_photo_url+`">`;
                }')
                ->footer('Photo')
                ->exportable(false)
                ->printable(false),
            ['data' => 'username', 'name' => 'username', 'title' => 'Username'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'country', 'name' => 'country', 'title' => 'Country'],
            ['data' => 'city', 'name' => 'city', 'title' => 'City'],
        ]);

        return view('user.partners.index', compact('html') + [
            'count' => $query->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partnerQuery = $request->user()->partner();
        if (with(clone $partnerQuery)->approved()->exists()) {
            return back()->with('error', 'You\'re Already A Partner Of Us.');
        }

        if ((!$partner = with(clone $partnerQuery)->approved(false)->first()) || $partner->updated_at->addDays(3)->isPast()) {
            $partner = with(clone $partnerQuery)->updateOrCreate([]);
        }

        return redirect()->action([static::class, 'show'], $partner)->with('success', 'Here Is Your Application.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        if ($partner->status === 'approved') {
            return back()->with('error', 'You\'re Already A Partner.');
        }
        return view('user.partners.show');
    }
}
