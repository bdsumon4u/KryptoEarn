<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\User;
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
            ->whereHas('partner', function ($query) {
                return $query->when($status = request('status'), function ($query) use ($status) {
                    $query->where(compact('status'));
                });
            })->with(['partner', 'membership.plan'])->withCount('referred');

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
            ['data' => 'membership.plan.name', 'title' => 'Plan'],
            Column::make('referred_count')
                ->title('Ref. Count')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    return this.referred_count;
                }')
                ->footer('Ref. Count')
                ->exportable(false)
                ->printable(false),
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'country', 'name' => 'country', 'title' => 'Country'],
            ['data' => 'partner.status', 'name' => 'partner.status', 'title' => 'Status'],
            ['data' => 'city', 'name' => 'city', 'title' => 'City'],
            Column::make('actions')
                ->title('Actions')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    var is_blocked = this.extra && this.extra.is_blocked;
                    return `<form action="/users/${this.id}/block" method="get">
                        `+(this.partner.status !== `approved` ? `<button class="btn btn-sm btn-success btn-approve" type="button" data-id="${this.partner.id}">Approve</button>`: ``)+`
                        <a class="btn btn-sm btn-primary" href="/users/`+this.id+`/edit">Edit</a>
                        <button type="submit" class="btn btn-sm ${is_blocked ? \'btn-success\' : \'btn-danger\'}">${is_blocked ? "Unblock" : "Block"}</button>
                    </form>`;
                }')
                ->footer('Actions')
                ->exportable(false)
                ->printable(false),
        ]);

        return view('admin.partners.index', compact('html'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        if ($request->approve) {
            $partner->update(['status' => 'approved']);
            return session()->flash('success', 'Approved.');
        }

        return session()->flash('error', 'Error Response.');
    }
}
