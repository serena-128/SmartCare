<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffMemberRequest;
use App\Http\Requests\UpdateStaffMemberRequest;
use App\Repositories\StaffMemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Message;



class StaffMemberController extends AppBaseController
{
    /** @var StaffMemberRepository $staffMemberRepository*/
    private $staffMemberRepository;

    public function __construct(StaffMemberRepository $staffMemberRepo)
    {
        $this->staffMemberRepository = $staffMemberRepo;
    }

    /**
     * Display a listing of the StaffMember.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $staffMembers = $this->staffMemberRepository->all();

        return view('staffmembers.index')
            ->with('staffMembers', $staffMembers);
    }

    /**
     * Show the form for creating a new StaffMember.
     *
     * @return Response
     */
    public function create()
    {
        return view('staffmembers.create');
    }

    /**
     * Store a newly created StaffMember in storage.
     *
     * @param CreateStaffMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateStaffMemberRequest $request)
    {
        $input = $request->all();

        $staffMember = $this->staffMemberRepository->create($input);

        Flash::success('Staff Member saved successfully.');

        return redirect(route('staffMembers.index'));
    }

    /**
     * Display the specified StaffMember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');

            return redirect(route('staffMembers.index'));
        }

        return view('staff_members.show')->with('staffMember', $staffMember);
    }

    /**
     * Show the form for editing the specified StaffMember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');

            return redirect(route('staffMembers.index'));
        }

        return view('staff_members.edit')->with('staffMember', $staffMember);
    }

    /**
     * Update the specified StaffMember in storage.
     *
     * @param int $id
     * @param UpdateStaffMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStaffMemberRequest $request)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');

            return redirect(route('staffMembers.index'));
        }

        $staffMember = $this->staffMemberRepository->update($request->all(), $id);

        Flash::success('Staff Member updated successfully.');

        return redirect(route('staffMembers.index'));
    }

    /**
     * Remove the specified StaffMember from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');

            return redirect(route('staffMembers.index'));
        }

        $this->staffMemberRepository->delete($id);

        Flash::success('Staff Member deleted successfully.');

        return redirect(route('staffMembers.index'));
    }
    
    public function profile()
    {
        return view('staffmember.profile');
    }

    
   public function viewMessages($messageId = null)
{
    // Fetch received messages
    $messages = Message::where('recipient', 'all')
                        ->orWhere('recipient', 'caregiver')
                        ->where('caregiver_id', auth()->user()->id) // Only show if the staff is the caregiver
                        ->get();

    // Fetch sent messages
    $sentMessages = Message::where('sender', auth()->user()->email)
                            ->get();

    // If no message ID is passed, get the first message
    $currentMessage = $messageId ? Message::findOrFail($messageId) : $messages->first();

    // Get the previous and next messages
    $previousMessage = $messages->where('id', '<', $currentMessage->id)->last();
    $nextMessage = $messages->where('id', '>', $currentMessage->id)->first();

    return view('staff.messages', compact('currentMessage', 'previousMessage', 'nextMessage', 'sentMessages'));
}


 public function reply(Request $request, $messageId)
    {
        // Find the message by ID
        $message = Message::findOrFail($messageId);

        // Get the Next of Kin's email (assuming `nextOfKin` is a relationship on the `Message` model)
        $nextOfKinEmail = $message->nextOfKin->email;

        // Create a new reply message
        $replyMessage = new Message();
        $replyMessage->message = $request->input('reply');
        $replyMessage->recipient = 'nextofkin';
        $replyMessage->caregiver_id = auth()->user()->id;
        $replyMessage->nextofkin_id = $message->nextofkin_id; // ✅ correct column name
        $replyMessage->sender = auth()->user()->firstname . ' ' . auth()->user()->lastname;
        $replyMessage->parent_id = $message->id;
        $replyMessage->save();


    

        return redirect()->route('staff.messages')->with('success', 'Reply sent successfully.');
    }

    public function redirectTo()
{
    $role = auth()->user()->staff_role;

    if (in_array($role, ['Manager', 'HR Coordinator', 'Operations Manager'])) {
        return '/management-dashboard';
    }

    // other redirects
}
public function manage()
{
    $staffMembers = \App\Models\StaffMember::all();
    return view('staff.manage', compact('staffMembers'));
}

}

