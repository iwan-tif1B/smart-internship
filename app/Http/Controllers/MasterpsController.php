<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailsSession;
use App\Models\Kategori;
use App\Models\Masterps;
use App\Models\Rent_session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterpsController extends Controller
{
    //index
    public function index()
    {
        //search by name, pagination 10
        $masterps = Masterps::where('name', 'like', '%' . request('name') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        // $kategori = Kategori::all();
        return view('pages.masterps.index', compact('masterps'));
    }

    //create
    public function create()
    {
        $url = route('masterps.store');
        $masterps = new Masterps();
        return view('pages.masterps.create', compact('url', 'masterps'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($request->id_master) {
            $masterps = Masterps::where('id', $request->id_master)->first();
            $masterps->update([
                'name' => $request->name,
                'price' => $request->price,
                'additional_fee' => $request->additional_fee,
                'updated_by' => auth()->user()->id,
                'updated_at' => date("Y-m-d H:i:s"),

            ]);
        } else {
            Masterps::create([
                'name' => $request->name,
                'price' => $request->price,
                'additional_fee' => $request->additional_fee,
                'created_by' => auth()->user()->id,
                'created_at' => date("Y-m-d H:i:s"),

            ]);
        }



        return redirect()->route('masterps.index')->with('success', 'Master PS Saved successfully');
    }

    //edit
    public function edit($id)
    {
        // $masterps = Masterps::findOne($id);
        $masterps = Masterps::where('id', $id)->first();
        $url = route('masterps.store');
        return view('pages.masterps.create', compact('masterps', 'url'));
    }

    //edit
    public function detail_masters($id)
    {
        $masterps = Masterps::where('id', $id)->first();
        $rent_session = Rent_session::where('name_session', 'like', '%' . request('name_session') . '%')
            ->where('masterps_id', $id)  // Menambahkan kondisi untuk masterps_id
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.masterps.details', compact('rent_session', 'masterps'));
    }

    public function create_rent_session($id)
    {
        $masterps = Masterps::where('id', $id)->first();
        $rent_session = new Rent_session();
        $url = route('masterps.store_rent_session');
        return view('pages.masterps.create_rent_details', compact('rent_session', 'masterps', 'url'));
    }

    //edit
    public function edit_rent_session($id)
    {
        $rent_session = Rent_session::where('id', $id)->first();
        $masterps = Masterps::where('id', $rent_session->masterps_id)->first();
        $url = route('masterps.store_rent_session');
        return view('pages.masterps.create_rent_details', compact('rent_session', 'masterps', 'url'));
    }
    //store rent session
    public function store_rent_session(Request $request)
    {
        $request->validate([
            'name_session' => 'required',
            'start_session' => 'required',
            'end_session' => 'required',
        ]);
        if ($request->id_rent_session) {
            $rent_session = Rent_session::where('id', $request->id_rent_session)->first();
            $rent_session->update([
                'name_session' => $request->name_session,
                'start_session' => $request->start_session,
                'end_session' => $request->end_session,
                'masterps_id' => $request->master_ps_id,
                'updated_by' => auth()->user()->id,
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        } else {
            Rent_session::create([
                'name_session' => $request->name_session,
                'start_session' => $request->start_session,
                'end_session' => $request->end_session,
                'masterps_id' => $request->master_ps_id,
                'created_by' => auth()->user()->id,
                'created_at' => date("Y-m-d H:i:s"),

            ]);
        }

        return redirect()->route('masterps.detail_masters', ['id' => $request->master_ps_id])
            ->with('success', 'Rent Session Saved successfully');
    }

    public function detail_session($id)
    {
        $rent_session = Rent_session::where('id', $id)->first();
        $detail_session = DetailsSession::where('name_playstation', 'like', '%' . request('name_playstation') . '%')
            ->where('rent_session_id', $id)  // Menambahkan kondisi untuk masterps_id
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.masterps.detail_session', compact('rent_session', 'detail_session'));
    }
    public function create_details_session($id)
    {
        $rent_session = Rent_session::where('id', $id)->first();
        $detail_session = new DetailsSession();
        $url = route('masterps.store_details_session');
        return view('pages.masterps.create_detail_session', compact('rent_session', 'detail_session', 'url'));
    }

    //edit
    public function edit_details_session($id)
    {
        $detail_session = DetailsSession::where('id', $id)->first();
        $rent_session = Rent_session::where('id', $detail_session->rent_session_id)->first();
        $url = route('masterps.store_details_session');
        return view('pages.masterps.create_detail_session', compact('detail_session', 'rent_session', 'url'));
    }
    //store rent session
    public function store_details_session(Request $request)
    {
        $request->validate([
            'name_playstation' => 'required',
        ]);
        if ($request->detail_session_id) {
            $detail_session = DetailsSession::where('id', $request->detail_session_id)->first();
            $detail_session->update([
                'name_playstation' => $request->name_playstation,
                'note' => $request->note,
                'rent_session_id' => $request->rent_session_id,
                'updated_by' => auth()->user()->id,
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        } else {
            DetailsSession::create([
                'name_playstation' => $request->name_playstation,
                'note' => $request->note,
                'rent_session_id' => $request->rent_session_id,
                'created_by' => auth()->user()->id,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }

        return redirect()->route('masterps.detail_session', ['id' => $request->rent_session_id])
            ->with('success', 'Details Session Saved successfully');
    }
    //destroy
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('masterps.index')->with('success', 'Buku deleted successfully');
    }
}
