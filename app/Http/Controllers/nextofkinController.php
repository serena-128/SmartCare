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
    // Validate inputs; note 'confirmed' expects new_password_confirmation
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::guard('nextofkin')->user();

    // Check if the current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    // Update the password (make sure you hash it)
    $user->password = Hash::make($request->new_password);
    
    if ($user->save()) {
        \Log::info('Password updated for user: ' . $user->id);
        // For debugging: you can dd($user->password) here to see the updated hash.
        // dd($user->password);
        return redirect()->back()->with('success', 'Password updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to update password. Please try again.');
    }
}
    
}
