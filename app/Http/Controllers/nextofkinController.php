<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenextofkinRequest;
use App\Http\Requests\UpdatenextofkinRequest;
use App\Repositories\nextofkinRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;  // Add this line
use App\Models\NextOfKin;
use Illuminate\Support\Facades\Http;
use App\Models\Message;



class nextofkinController extends AppBaseController
{
    /** @var nextofkinRepository $nextofkinRepository*/
    private $nextofkinRepository;

    public function __construct(nextofkinRepository $nextofkinRepo)
    {
        $this->nextofkinRepository = $nextofkinRepo;
    }

    /**
     * Display a listing of the nextofkin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $nextofkins = $this->nextofkinRepository->all();

        return view('nextofkins.index')
            ->with('nextofkins', $nextofkins);
    }

    /**
     * Show the form for creating a new nextofkin.
     *
     * @return Response
     */
    public function create()
    {
        return view('nextofkins.create');
    }

    /**
     * Store a newly created nextofkin in storage.
     *
     * @param CreatenextofkinRequest $request
     *
     * @return Response
     */
    public function store(CreatenextofkinRequest $request)
    {
        $input = $request->all();

        $nextofkin = $this->nextofkinRepository->create($input);

        Flash::success('Nextofkin saved successfully.');

        return redirect(route('nextofkins.index'));
    }

    /**
     * Display the specified nextofkin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nextofkin = $this->nextofkinRepository->find($id);

        if (empty($nextofkin)) {
            Flash::error('Nextofkin not found');

            return redirect(route('nextofkins.index'));
        }

        return view('nextofkins.show')->with('nextofkin', $nextofkin);
    }

    /**
     * Show the form for editing the specified nextofkin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nextofkin = $this->nextofkinRepository->find($id);

        if (empty($nextofkin)) {
            Flash::error('Nextofkin not found');

            return redirect(route('nextofkins.index'));
        }

        return view('nextofkins.edit')->with('nextofkin', $nextofkin);
    }

    /**
     * Update the specified nextofkin in storage.
     *
     * @param int $id
     * @param UpdatenextofkinRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenextofkinRequest $request)
    {
        $nextofkin = $this->nextofkinRepository->find($id);

        if (empty($nextofkin)) {
            Flash::error('Nextofkin not found');

            return redirect(route('nextofkins.index'));
        }

        $nextofkin = $this->nextofkinRepository->update($request->all(), $id);

        Flash::success('Nextofkin updated successfully.');

        return redirect(route('nextofkins.index'));
    }

    /**
     * Remove the specified nextofkin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nextofkin = $this->nextofkinRepository->find($id);

        if (empty($nextofkin)) {
            Flash::error('Nextofkin not found');

            return redirect(route('nextofkins.index'));
        }

        $this->nextofkinRepository->delete($id);

        Flash::success('Nextofkin deleted successfully.');

        return redirect(route('nextofkins.index'));
    }
    
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::guard('nextofkin')->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()
            ->withErrors(['current_password' => 'Current password is incorrect'])
            ->withInput()
            ->with('active_tab', 'settings');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()
        ->with('success', 'Password updated successfully!')
        ->with('active_tab', 'settings');
}
public function sendMessage(Request $request)
{
    $validated = $request->validate([
        'message' => 'required|string',
        'recipient' => 'required|in:caregiver,staff,all',
    ]);

    $nextofkin = auth()->guard('nextofkin')->user();
    $nextofkinId = $nextofkin->id;
    $sender = $nextofkin->firstname . ' ' . $nextofkin->lastname;

    try {
        if ($validated['recipient'] === 'all') {
            Message::create([
                'message' => $validated['message'],
                'sender' => $sender,
                'recipient' => 'all',
                'nextofkin_id' => $nextofkinId,
            ]);
        } elseif ($validated['recipient'] === 'caregiver') {
            if (!$nextofkin->resident) {
                return redirect()->back()->with('error', 'No resident linked to your account.');
            }

            if (!$nextofkin->resident->assignedCaregiver) {
                return redirect()->back()->with('error', 'No caregiver assigned to your resident.');
            }

            Message::create([
                'message' => $validated['message'],
                'sender' => $sender,
                'recipient' => 'caregiver',
                'caregiver_id' => $nextofkin->resident->assignedCaregiver->id,
                'nextofkin_id' => $nextofkinId,
            ]);
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error sending message: ' . $e->getMessage());
    }
}
public function showReceivedMessages()
{
    $nextofkinId = auth()->guard('nextofkin')->id();

    $receivedMessages = Message::where('recipient', 'nextofkin')
                              ->where('nextofkin_id', $nextofkinId)
                              ->orderBy('created_at', 'desc')
                              ->get();

    return view('nextofkin.dashboard', compact('receivedMessages'));
}

    // In app/Http/Controllers/nextofkinController.php

public function staffViewNextOfKin()
{
    $nextOfKinData = NextOfKin::with('resident')->get();
    $residents = \App\Models\Resident::all(); // Needed for the dropdown

    return view('staff.nextofkin.index', compact('nextOfKinData', 'residents'));
}

    public function editFromStaffView($id)
{
    $kin = NextOfKin::findOrFail($id);
    $residents = \App\Models\Resident::all(); // for dropdown if needed

    return view('staff.nextofkin.edit', compact('kin', 'residents'));
}
    public function staffUpdateNextOfKin(Request $request, $id)
{
    $kin = NextOfKin::findOrFail($id);

    $kin->update([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'relationshiptoresident' => $request->relationshiptoresident,
        'contactnumber' => $request->contactnumber,
        'resident_id' => $request->resident_id,
    ]);

    return response()->json(['message' => 'Next of Kin updated successfully!']);

}


}
