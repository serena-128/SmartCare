<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffMemberRequest;
use App\Http\Requests\UpdateStaffMemberRequest;
use App\Repositories\StaffMemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\StaffMember;
use Flash;
use Response;
use App\Models\Message;

class StaffMemberController extends AppBaseController
{
    private $staffMemberRepository;

    public function __construct(StaffMemberRepository $staffMemberRepo)
    {
        $this->staffMemberRepository = $staffMemberRepo;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $staff = StaffMember::query()
            ->when($search, function ($query, $search) {
                $query->where('firstname', 'like', "%$search%")
                      ->orWhere('lastname', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('staff_role', 'like', "%$search%")
                      ->orWhere('contactnumber', 'like', "%$search%")
                      ->orWhere('reportsto', 'like', "%$search%");
            })
            ->when($role, function ($query, $role) {
                $query->where('staff_role', $role);
            })
            ->orderBy('firstname')
            ->paginate(10);

        return view('staffmembers.index', [
            'staffMembers' => $staff,
            'search' => $search,
            'role' => $role
        ]);
    }

    public function create()
    {
        return view('staffmembers.create');
    }

    public function store(CreateStaffMemberRequest $request)
    {
        $input = $request->all();
        $this->staffMemberRepository->create($input);

        Flash::success('Staff Member saved successfully.');
        return redirect(route('staffmembers.index'));
    }

    public function show($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');
            return redirect(route('staffmembers.index'));
        }

        return view('staffmembers.staff_profile')->with('staffMember', $staffMember);
    }

    public function edit($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');
            return redirect(route('staffmembers.index'));
        }

        return view('staffmembers.edit')->with('staffMember', $staffMember);
    }

    public function update($id, UpdateStaffMemberRequest $request)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');
            return redirect(route('staffmembers.index'));
        }

        $this->staffMemberRepository->update($request->all(), $id);

        Flash::success('Staff Member updated successfully.');
        return redirect(route('staffmembers.index'));
    }

    public function destroy($id)
    {
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            Flash::error('Staff Member not found');
            return redirect(route('staffmembers.index'));
        }

        $this->staffMemberRepository->delete($id);

        Flash::success('Staff Member deleted successfully.');
        return redirect(route('staffmembers.index'));
    }

    public function profile()
    {
        return view('staffmembers.profile');
    }

    public function viewMessages($messageId = null)
    {
        $messages = Message::where('recipient', 'all')
                            ->orWhere('recipient', 'caregiver')
                            ->where('caregiver_id', auth()->user()->id)
                            ->get();

        $sentMessages = Message::where('sender', auth()->user()->email)->get();
        $currentMessage = $messageId ? Message::findOrFail($messageId) : $messages->first();
        $previousMessage = $messages->where('id', '<', $currentMessage->id)->last();
        $nextMessage = $messages->where('id', '>', $currentMessage->id)->first();

        return view('staff.messages', compact('currentMessage', 'previousMessage', 'nextMessage', 'sentMessages'));
    }

    public function reply(Request $request, $messageId)
    {
        $message = Message::findOrFail($messageId);

        $replyMessage = new Message();
        $replyMessage->message = $request->input('reply');
        $replyMessage->recipient = 'nextofkin';
        $replyMessage->caregiver_id = auth()->user()->id;
        $replyMessage->nextofkin_id = $message->nextofkin_id;
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
    }

    public function manage()
    {
        $staffMembers = StaffMember::all();
        return view('staffmembers.manage', compact('staffMembers'));
    }

    public function searchPage()
    {
        return view('staffmembers.search');
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('query');

        $staff = StaffMember::where('firstname', 'LIKE', "%{$query}%")
            ->orWhere('lastname', 'LIKE', "%{$query}%")
            ->orWhere('staff_role', 'LIKE', "%{$query}%")
            ->first();

        return view('staffmembers.staff_profile')->with('staffMember', $staff);
    }
    public function supervisor()
{
    return $this->belongsTo(StaffMember::class, 'reportsto');
}

}
