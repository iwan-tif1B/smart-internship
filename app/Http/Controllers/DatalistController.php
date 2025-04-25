<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Buku;
use App\Models\DetailsSession;
use App\Models\Kategori;
use App\Models\Masterps;
use App\Models\QuequeSession;
use App\Models\Rent_session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatalistController extends Controller
{
    //index
    public function index()
    {
        //search by name, pagination 10
        $masterps = Masterps::where('name', 'like', '%' . request('name') . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.datalist.index', compact('masterps'));
    }
    //search
    public function search_playstation(Request $request)
    {
        $detail_id = $request->input('detail_id');
        $date = $request->input('date');

        // Eager load the related models and filter using whereHas
        $rent_sessions = DetailsSession::with(['rentSession.masterps']) // Gunakan nama relasi yang benar
            ->whereHas('rentSession.masterps', function ($query) use ($detail_id) {
                $query->where('id', $detail_id); // Menyesuaikan dengan kolom id pada masterps
            })
            ->get();

        // Prepare the response
        $response_detail = [];
        foreach ($rent_sessions as $i_session) {
            $cek_note = $this->checknote($date, $i_session->rentSession->masterps);
            $get_booked = $this->get_booked_disabled_or_enabled($i_session->id, $date);
            $response_detail[] = [
                "id" => $i_session->id,
                "name" => $i_session->name_playstation,
                "session" => $i_session->rentSession->name_session,
                "hour" => $this->count_hour($i_session->rentSession->start_session, $i_session->rentSession->end_session),
                "duration" => "Start from " . $i_session->rentSession->start_session . " WIB to " . $i_session->rentSession->end_session . "  Wib",
                "note" => $i_session->note . $cek_note['note'],
                "booked" => $get_booked['status'],
                "color" => $get_booked['color'],
                "price" => $cek_note['price'],
            ];
        }

        $response = [
            "response" => [
                "data" => $response_detail
            ]
        ];

        return response()->json($response);
    }

    // store payment
    public function store_payment(Request $request)
    {
        try {
            // Retrieve input data
            $detail_id = $request->input('id');
            $price = $request->input('price');
            $date = $request->input('date');
            $note = $request->input('note');

            // Remove commas and convert to integer
            $price = (int) str_replace(',', '', $price);

            // Check if there's an existing queue session for the given date and detail_id
            $queque = QuequeSession::where("details_rent_playstation_id", $detail_id)
                ->whereDate('date', $date)
                ->first();

            // If no queue session found, create a new one
            if (!$queque) {
                $queque = new QuequeSession();
                $queque->status = QuequeSession::belum_booked;
                $queque->details_rent_playstation_id = $detail_id;
                $queque->date = date("Y-m-d", strtotime($date));
                $queque->created_by = auth()->user()->id;
                $queque->note = $note;
                $queque->created_at = now();
                $queque->save();

                // Create a new bill
                $bill = new Bill();
                $bill->status_bill = Bill::belum_lunas;
                $bill->time_order = now();
                $bill->queque_session_id = $queque->id;
                $bill->id_user = auth()->user()->id;
                $bill->note = $note;
                $bill->total = $price;
                $bill->created_by = auth()->user()->id;
                $bill->created_at = now();
                $bill->save();
                $response = [
                    "response" => [
                        "id" => auth()->user()->id
                    ],
                    "metadata" => [
                        "message" => "Success",
                        "code" => 200
                    ]
                ];
            } else {
                $response = [
                    "response" => [
                        "id" => null
                    ],
                    "metadata" => [
                        "message" => "Anda telah melakukan booking pada sesi ini",
                        "code" => 500
                    ]
                ];
            }
            // Return success response
            return response()->json($response);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            $response = [
                "response" => [
                    "url" => null
                ],
                "metadata" => [
                    "message" => "Error: " . $e->getMessage(),
                    "code" => 500
                ]
            ];

            // Return error response
            return response()->json($response, 500);
        }
    }



    //edit
    public function show()
    {
        $bill = Bill::where('status_bill', 'like', '%' . request('status_bill') . '%')
            ->where('id_user', 23)
            ->where('deleted_at', null)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.datalist.listbooked', compact('bill'));
    }

    public function create_rent_session($id)
    {
        $masterps = Masterps::where('id', $id)->first();
        $rent_session = new Rent_session();
        $url = route('masterps.store_rent_session');
        return view('pages.datalist.create_rent_details', compact('rent_session', 'masterps', 'url'));
    }

    //edit
    public function edit_rent_session($id)
    {
        $rent_session = Rent_session::where('id', $id)->first();
        $masterps = Masterps::where('id', $rent_session->masterps_id)->first();
        $url = route('masterps.store_rent_session');
        return view('pages.datalist.create_rent_details', compact('rent_session', 'masterps', 'url'));
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
        return view('pages.datalist.detail_session', compact('rent_session', 'detail_session'));
    }
    public function create_details_session($id)
    {
        $rent_session = Rent_session::where('id', $id)->first();
        $detail_session = new DetailsSession();
        $url = route('masterps.store_details_session');
        return view('pages.datalist.create_detail_session', compact('rent_session', 'detail_session', 'url'));
    }

    //edit
    public function edit_details_session($id)
    {
        $detail_session = DetailsSession::where('id', $id)->first();
        $rent_session = Rent_session::where('id', $detail_session->rent_session_id)->first();
        $url = route('masterps.store_details_session');
        return view('pages.datalist.create_detail_session', compact('detail_session', 'rent_session', 'url'));
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

    // function count hour
    public static function count_hour($start, $end)
    {
        // Mengonversi start_session dan end_session ke timestamp
        $start_timestamp = strtotime($start);
        $end_timestamp = strtotime($end);
        $diff_in_seconds = $end_timestamp - $start_timestamp;
        $diff_in_hours = $diff_in_seconds / 3600;
        return $diff_in_hours;
    }

    // function get booked disabled or enabled
    public static function get_booked_disabled_or_enabled($details_rent_playstation_id, $date)
    {
        $value = ["status" => 'disabled', "color" => "secondary"];
        $queque = QuequeSession::where('details_rent_playstation_id', $details_rent_playstation_id)
            ->whereDate('date', $date) // Gunakan whereDate untuk membandingkan hanya tanggal
            ->where('status', true)
            ->first();
        if (empty($queque)) {
            $value = ["status" => '', "color" => "success"];
        }
        return $value;
    }

    // add condtion if day is weekend
    public static function checknote($date, $masterps)
    {
        $date_booking = date("D", strtotime($date));
        $response = ['note' => $date_booking, 'price' => $masterps->price];
        if ($date_booking == "Sat" || $date_booking == "Sun") {
            $price = $masterps->additional_fee + $masterps->price;
            $response = ['note' => ", Orders on holidays will be subject to an additional charge of " . $masterps->additional_fee, 'price' => number_format($price)];
        }
        return $response;
    }
}
