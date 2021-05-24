<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NoticeMail;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(Notice::query())->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            Column::make('actions')
                ->title('Actions')
                ->searchable(false)
                ->orderable(false)
                ->render('function(){
                    var is_blocked = this.extra && this.extra.is_blocked;
                    var csrf_token = document.querySelector(`meta[name="csrf-token"]`).getAttribute("content");
                    return `<form action="/notices/${this.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf_token}" />
                        <input type="hidden" name="_method" value="DELETE" />
                        <a class="btn btn-sm btn-primary" href="/notices/`+this.id+`/edit">Detail</a>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>`;
                }')
                ->footer('Actions')
                ->exportable(false)
                ->printable(false),
        ])->parameters([
            'order' => [
                0, // here is the column number
                'desc'
            ],
        ]);

        return view('admin.notices.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notices.editor', [
            'notice' => new Notice,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->data($request);

        data_get($data, 'on_site', false) && Notice::create($data);
        data_get($data, 'on_mail', false) && $this->mail($data);

        return redirect()->action([static::class, 'index'])->with('success', 'Notice Published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('admin.notices.editor');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $data = $this->data($request);

        data_get($data, 'on_site', false) && $notice->update($data);
        data_get($data, 'on_mail', false) && $this->mail($data);

        return redirect()->action([static::class, 'index'])->with('success', 'Notice Published');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return back()->with('success', 'Notice Has Been Deleted.');
    }

    private function data(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'on_site' => 'required_without:on_mail',
            'on_mail' => 'required_without:on_site',
        ]);
    }

    private function mail(array $data)
    {
        Mail::send(new NoticeMail($data));
//        User::select('email')->get()->each(function ($user) use ($data) {
//            Mail::to($user)->send(new NoticeMail($data));
//        });
    }
}
