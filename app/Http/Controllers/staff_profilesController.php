<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createstaff_profilesRequest;
use App\Http\Requests\Updatestaff_profilesRequest;
use App\Repositories\staff_profilesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class staff_profilesController extends AppBaseController
{
    /** @var staff_profilesRepository $staffProfilesRepository*/
    private $staffProfilesRepository;

    public function __construct(staff_profilesRepository $staffProfilesRepo)
    {
        $this->staffProfilesRepository = $staffProfilesRepo;
    }

    /**
     * Display a listing of the staff_profiles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $userId = auth()->id();
        $staffProfile = \App\Models\StaffProfile::where('user_id', $userId)->first();
    
        if (!$staffProfile) {
            return redirect()->route('staffProfiles.create');
        }
    
        return redirect()->route('staffProfiles.show', $staffProfile->id);
    }
    

    /**
     * Show the form for creating a new staff_profiles.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff_profiles.create');
    }

    /**
     * Store a newly created staff_profiles in storage.
     *
     * @param Createstaff_profilesRequest $request
     *
     * @return Response
     */
    public function store(Createstaff_profilesRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id(); // attach logged-in user
    
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }
    
        \App\Models\StaffProfile::create($data);
    
        return redirect()->route('staffProfiles.index')->with('success', 'Profile created successfully!');
    }
    

    /**
     * Display the specified staff_profiles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staffProfile = \App\Models\StaffProfile::findOrFail($id);
    
        // Check if the profile belongs to the current user
        if ($staffProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }
    
        return view('staff_profiles.show', compact('staffProfile'));
    }
    

    /**
     * Show the form for editing the specified staff_profiles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staffProfiles = $this->staffProfilesRepository->find($id);

        if (empty($staffProfiles)) {
            Flash::error('Staff Profiles not found');

            return redirect(route('staffProfiles.index'));
        }

        return view('staff_profiles.edit')->with('staffProfiles', $staffProfiles);
    }

    /**
     * Update the specified staff_profiles in storage.
     *
     * @param int $id
     * @param Updatestaff_profilesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestaff_profilesRequest $request)
    {
        $staffProfiles = $this->staffProfilesRepository->find($id);

        if (empty($staffProfiles)) {
            Flash::error('Staff Profiles not found');

            return redirect(route('staffProfiles.index'));
        }

        $staffProfiles = $this->staffProfilesRepository->update($request->all(), $id);

        Flash::success('Staff Profiles updated successfully.');

        return redirect(route('staffProfiles.index'));
    }

    /**
     * Remove the specified staff_profiles from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staffProfiles = $this->staffProfilesRepository->find($id);

        if (empty($staffProfiles)) {
            Flash::error('Staff Profiles not found');

            return redirect(route('staffProfiles.index'));
        }

        $this->staffProfilesRepository->delete($id);

        Flash::success('Staff Profiles deleted successfully.');

        return redirect(route('staffProfiles.index'));
    }
    public function myProfile()
    {
        $userId = auth()->id();
        $profile = \App\Models\StaffProfile::where('user_id', $userId)->first();
    
        if (!$profile) {
            return redirect()->route('staffProfiles.create')->with('warning', 'Please create your profile.');
        }
    
        return redirect()->route('staffProfiles.show', $profile->id);
    }
    
    
}
