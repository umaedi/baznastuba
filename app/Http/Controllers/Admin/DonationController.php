<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('admin.donation.index');
    }

    /**
     * filter
     *
     * @param  mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'date_from'  => 'required',
            'date_to'    => 'required',
        ]);

        $date_from  = $request->date_from;
        $date_to    = $request->date_to;

        //get data donation by range date
        $donations = Donation::where('status', 'success')->whereDate('created_at', '>=', $request->date_from)->whereDate('created_at', '<=', $request->date_to)->get();

        //get total donation by range date    
        $total = Donation::where('status', 'success')->whereDate('created_at', '>=', $request->date_from)->whereDate('created_at', '<=', $request->date_to)->sum('amount');

        return view('admin.donation.index', compact('donations', 'total'));
    }

    public function donation()
    {
        $konfirmasi = Donation::where('status', 'pending')->paginate();
        return view('admin.donation.konfirmasi', compact('konfirmasi'));
    }

    public function konfirmasi(Request $request)
    {
        $donation = Donation::findOrfail($request->id);
        $donation->update(['status' =>  'success']);

        if ($donation) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.donation.konfirmasi')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.donation.konfirmasi')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
