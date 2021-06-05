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
            ->with('membership.plan')
            ->where('country', request()->user()->country)
            ->whereHas('partner', function ($query) {
                return $query->approved();
            });

        if (request()->ajax()) {
            return DataTables::of($query)->toJson();
        }

        $html = $builder->columns([
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            Column::make('package')
                ->title('Package')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    return this.membership.plan.name;
                }')
                ->footer('Package')
                ->exportable(false)
                ->printable(false),
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
//            ['data' => 'country', 'name' => 'country', 'title' => 'Country'],
            ['data' => 'language', 'name' => 'language', 'title' => 'Language'],
            ['data' => 'city', 'name' => 'city', 'title' => 'City'],
            ['data' => 'road_no', 'name' => 'road_no', 'title' => 'Road No'],
            ['data' => 'postal_code', 'name' => 'postal_code', 'title' => 'Postal Code'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
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
        if (request()->user()->partner()->approved()->exists()) {
            return back()->with('error', 'You\'re Already A Partner Of Us.');
        }

        if ($partner = \request()->user()->partner) {
            if ($partner->created_at->addWeek()->isPast()) {
                $partner->delete(); # Automatically Delete Applications Older Than One Week.
            } else {
                return redirect()->action([static::class, 'show'], $partner);
            }
        }

        if (\request()->user()->profile_photo_path) {
            return back()->with('error', '<a href="'.url('/user/profile').'">Upload</a> Your Profile Photo From');
        }

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
        $data = $request->validate([
            'city' => 'required',
            'road_no' => 'nullable',
            'postal_code' => 'required',
            'language' => 'required',
            'address' => 'required',
        ]);

        $user = $request->user();
        if ((!$partner = $user->partner()->approved(false)->first()) || $partner->updated_at->addDays(3)->isPast()) {
            $user->update($data);
            $partner = $user->partner()->updateOrCreate([]);
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
