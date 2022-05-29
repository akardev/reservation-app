<?php

namespace App\Http\Controllers\Admin;

use App\Enums\tableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', tableStatus::Mevcut)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {

        $table = Table::findOrFail($request->table_id);

        if ($request->guestNumber >  $table->guestNumber) {
            return back()->with('warning', 'Mevcut masa kapasitesi ' . $table->guestNumber . ' kişiliktir!');
        }

        $requestDate = Carbon::parse($request->resTime);
        foreach ($table->reservations as $res) {
            if ($res->resTime->isoFormat('LLLL') == $requestDate->isoFormat('LLLL')) {
                return back()->with('warning', 'Bu tarihte mevcut bir rezervasyon bulunmaktadır!');
            }
        }


        Reservation::create($request->validated());

        return redirect()->route('admin.reservations.index')->with('success', 'Rezervasyon başarıyla oluşturuldu');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', tableStatus::Mevcut)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guestNumber >  $table->guestNumber) {
            return back()->with('warning', 'Mevcut masa kapasitesi ' . $table->guestNumber . ' kişiliktir!');
        }

        $requestDate = Carbon::parse($request->resTime);
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        foreach ($reservations as $res) {
            if ($res->resTime->isoFormat('LLLL') == $requestDate->isoFormat('LLLL')) {
                return back()->with('warning', 'Bu tarihte mevcut bir rezervasyon bulunmaktadır!');
            }
        }

        $reservation->update($request->validated());
        return redirect()->route('admin.reservations.index')->with('success', 'Rezervasyon başarıyla güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {

        $reservation->delete();
        return to_route('admin.reservations.index')->with('success', 'Rezervasyon başarıyla silindi');
    }
}
