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

    $recipient = $validated['recipient'];
    $sender = auth()->user()->firstname . ' ' . auth()->user()->lastname;
    $nextofkinId = auth()->id(); 

    if ($recipient === 'all') {
        // Send message to all staff
        Message::create([
            'message' => $validated['message'],
            'sender' => $sender,
            'recipient' => 'all',
            'nextofkin_id' => $nextofkinId,
        ]);
    } elseif ($recipient === 'caregiver') {
        // Send message to the assigned caregiver
        $resident = auth()->user()->resident; // Get the resident linked to the Next of Kin

        if ($resident && $resident->assignedCaregiver) {
            $caregiver = $resident->assignedCaregiver; // Get the assigned caregiver

            // Store the message for the assigned caregiver
            Message::create([
                'message' => $validated['message'],
                'sender' => $sender,
                'recipient' => 'caregiver',
                'caregiver_id' => $caregiver->id, // Store the caregiver's ID
                'nextofkin_id' => $nextofkinId,
            ]);
        } else {
            return redirect()->back()->with('error', 'No caregiver assigned to this resident.');
        }
    }

    return redirect()->back()->with('success', 'Message sent successfully!');
}
    public function showReceivedMessages()
{
    // Fetch messages where the logged-in next of kin is the recipient
    $receivedMessages = Message::where('recipient', 'nextofkin')
                                ->where('nextofkin_id', auth()->guard('nextofkin')->user()->id)
                                ->get();

    return view('nextofkin.dashboard', compact('receivedMessages'));
}

    
}
