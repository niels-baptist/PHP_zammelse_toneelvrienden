<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $mails = Mail::orderBy('subject')->get();
        $result = compact('mails');
        Json::dump($result);
        return view('admin.mails.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.mails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required|max:255',
            'mailContent' => 'required|min:5|max:255',
        ]);
        $mail = new Mail();
        $mail->subject = $request->subject;
        $mail->content = $request->mailContent;
        $mail->save();

        session()->flash('success', "De nieuwe mail <b>$mail->subject</b> werd succesvol aangemaakt");
        return redirect('admin/mails');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function show(Mail $mail)
    {
        return redirect("/admin/mails/{$mail->id}/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Mail $mail)
    {
        $result = compact('mail');
        Json::dump($result);
        return view('admin.mails.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mail  $mail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Mail $mail)
    {
        $this->validate($request,[
            'subject' => 'required|max:255',
            'mailContent' => 'required|min:5|max:255',
        ]);
        $mail->subject = $request->subject;
        $mail->content = $request->mailContent;
        $mail->save();

        session()->flash('success', "De mail <b>$mail->subject</b> werd succesvol bijgewerkt");
        return redirect("admin/mails");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Mail $mail)
    {
        $mail->delete();

        session()->flash('success', "De mail <b>$mail->subject</b> werd succesvol verwijderd");
        return redirect('admin/mails');
    }
}
