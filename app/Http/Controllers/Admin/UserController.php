<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(User::query())->toJson();
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'country', 'name' => 'country', 'title' => 'Country'],
            ['data' => 'city', 'name' => 'city', 'title' => 'City'],
            Column::make('detail')
                ->title('Detail')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    return `<a class="btn btn-sm btn-primary" href="/users/`+this.id+`/edit">Detail</a>`;
                }')
                ->footer('Detail')
                ->exportable(false)
                ->printable(false),
        ]);

        return view('admin.users.index', compact('html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user->load('wallets'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return back()->with('success', 'User Data Is Updated.');
    }
}
