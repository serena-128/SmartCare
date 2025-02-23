<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createmedication_remindersRequest;
use App\Http\Requests\Updatemedication_remindersRequest;
use App\Repositories\medication_remindersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class medication_remindersController extends AppBaseController
{
    /** @var medication_remindersRepository $medicationRemindersRepository*/
    private $medicationRemindersRepository;

    public function __construct(medication_remindersRepository $medicationRemindersRepo)
    {
        $this->medicationRemindersRepository = $medicationRemindersRepo;
    }

    /**
     * Display a listing of the medication_reminders.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $medicationReminders = $this->medicationRemindersRepository->all();

        return view('medication_reminders.index')
            ->with('medicationReminders', $medicationReminders);
    }

    /**
     * Show the form for creating a new medication_reminders.
     *
     * @return Response
     */
    public function create()
    {
        return view('medication_reminders.create');
    }

    /**
     * Store a newly created medication_reminders in storage.
     *
     * @param Createmedication_remindersRequest $request
     *
     * @return Response
     */
    public function store(Createmedication_remindersRequest $request)
    {
        $input = $request->all();

        $medicationReminders = $this->medicationRemindersRepository->create($input);

        Flash::success('Medication Reminders saved successfully.');

        return redirect(route('medicationReminders.index'));
    }

    /**
     * Display the specified medication_reminders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicationReminders = $this->medicationRemindersRepository->find($id);

        if (empty($medicationReminders)) {
            Flash::error('Medication Reminders not found');

            return redirect(route('medicationReminders.index'));
        }

        return view('medication_reminders.show')->with('medicationReminders', $medicationReminders);
    }

    /**
     * Show the form for editing the specified medication_reminders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicationReminders = $this->medicationRemindersRepository->find($id);

        if (empty($medicationReminders)) {
            Flash::error('Medication Reminders not found');

            return redirect(route('medicationReminders.index'));
        }

        return view('medication_reminders.edit')->with('medicationReminders', $medicationReminders);
    }

    /**
     * Update the specified medication_reminders in storage.
     *
     * @param int $id
     * @param Updatemedication_remindersRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemedication_remindersRequest $request)
    {
        $medicationReminders = $this->medicationRemindersRepository->find($id);

        if (empty($medicationReminders)) {
            Flash::error('Medication Reminders not found');

            return redirect(route('medicationReminders.index'));
        }

        $medicationReminders = $this->medicationRemindersRepository->update($request->all(), $id);

        Flash::success('Medication Reminders updated successfully.');

        return redirect(route('medicationReminders.index'));
    }

    /**
     * Remove the specified medication_reminders from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicationReminders = $this->medicationRemindersRepository->find($id);

        if (empty($medicationReminders)) {
            Flash::error('Medication Reminders not found');

            return redirect(route('medicationReminders.index'));
        }

        $this->medicationRemindersRepository->delete($id);

        Flash::success('Medication Reminders deleted successfully.');

        return redirect(route('medicationReminders.index'));
    }
}
