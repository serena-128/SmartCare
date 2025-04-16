<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createstaff_profilesRequest;
use App\Http\Requests\Updatestaff_profilesRequest;
use App\Repositories\StaffProfilesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\StaffProfile;
use Flash;
use Response;

class StaffProfilesController extends AppBaseController
{
    /** @var StaffProfilesRepository */
    private $staffProfilesRepository;

    public function __construct(StaffProfilesRepository $staffProfilesRepo)
    {
        $this->staffProfilesRepository = $staffProfilesRepo;
    }

    /**
     * Display the profile of the currently logged-in staff member.
     */
    public function index()
    {
        $userId = auth()->id();
        $staffProfile = StaffProfile::where('user_id', $userId)->first();
    
        if (!$staffProfile) {
            return redirect()->route('staffProfiles.create')->with('warning', 'No profile found. Please create one.');
        }
    
        return redirect()->route('staffProfiles.show', $staffProfile->id);
    }
    

    /**
     * Show the form for creating a new staff profile.
     */
public function create()
{
    return view('staffProfiles.create');
}


    /**
     * Store a newly created staff profile in storage.
     */
    public function store(Createstaff_profilesRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        StaffProfile::create($data);

        Flash::success('Profile created successfully!');
        return redirect()->route('staffProfiles.index');
    }

    /**
     * Display the specified staff profile.
     */
    public function show($id)
    {
        $staffProfile = StaffProfile::findOrFail($id);

        if ($staffProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('staff_profiles.show', compact('staffProfile'));
    }

    /**
     * Show the form for editing the specified staff profile.
     */
    public function edit($id)
    {
        $staffProfile = $this->staffProfilesRepository->find($id);

        if (empty($staffProfile)) {
            Flash::error('Staff Profile not found');
            return redirect(route('staffProfiles.index'));
        }

        if ($staffProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('staff_profiles.edit')->with('staffProfiles', $staffProfile);
    }

    /**
     * Update the specified staff profile in storage.
     */
    public function update($id, Updatestaff_profilesRequest $request)
    {
        $staffProfile = $this->staffProfilesRepository->find($id);

        if (empty($staffProfile)) {
            Flash::error('Staff Profile not found');
            return redirect(route('staffProfiles.index'));
        }

        if ($staffProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        $this->staffProfilesRepository->update($data, $id);

        Flash::success('Profile updated successfully.');
        return redirect(route('staffProfiles.index'));
    }

    /**
     * Remove the specified staff profile from storage.
     */
    public function destroy($id)
    {
        $staffProfile = $this->staffProfilesRepository->find($id);

        if (empty($staffProfile)) {
            Flash::error('Staff Profile not found');
            return redirect(route('staffProfiles.index'));
        }

        if ($staffProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $this->staffProfilesRepository->delete($id);

        Flash::success('Profile deleted successfully.');
        return redirect(route('staffProfiles.index'));
    }

    /**
     * Shortcut route: /my-profile → current user's profile.
     */
    public function myProfile()
{
    if (!session()->has('staff_id')) {
        return redirect()->route('login');
    }

    $staff = \App\Models\StaffMember::find(session('staff_id'));

    if (!$staff) {
        return redirect()->route('login')->with('error', 'Staff member not found.');
    }

    return view('my_profile', compact('staff'));
}

}
