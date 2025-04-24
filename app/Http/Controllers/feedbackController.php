<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefeedbackRequest;
use App\Http\Requests\UpdatefeedbackRequest;
use App\Repositories\feedbackRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class feedbackController extends AppBaseController
{
    /** @var feedbackRepository $feedbackRepository*/
    private $feedbackRepository;

    public function __construct(feedbackRepository $feedbackRepo)
    {
        $this->feedbackRepository = $feedbackRepo;
    }

    /**
     * Display a listing of the feedback.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $feedback = \App\Models\Feedback::orderBy('created_at', 'desc')->paginate(10);
        return view('feedback.index', compact('feedback'));
    }
    

    /**
     * Show the form for creating a new feedback.
     *
     * @return Response
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created feedback in storage.
     *
     * @param CreatefeedbackRequest $request
     *
     * @return Response
     */
    public function store(CreatefeedbackRequest $request)
    {
        $input = $request->all();
    
        // Check for anonymity
        $input['staff_id'] = $request->has('is_anonymous') ? null : auth()->user()->id;
        $input['is_anonymous'] = $request->has('is_anonymous') ? true : false;
    
        // Handle file upload
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('feedback_files', 'public');
            $input['attachment'] = $path;
        }
    
        $this->feedbackRepository->create($input);
    
        Flash::success('Feedback submitted successfully.');
        return redirect(route('feedback.index'));
    }
    

    /**
     * Display the specified feedback.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feedback = $this->feedbackRepository->find($id);

        if (empty($feedback)) {
            Flash::error('Feedback not found');

            return redirect(route('feedback.index'));
        }

        return view('feedback.show')->with('feedback', $feedback);
    }

    /**
     * Show the form for editing the specified feedback.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feedback = $this->feedbackRepository->find($id);

        if (empty($feedback)) {
            Flash::error('Feedback not found');

            return redirect(route('feedback.index'));
        }

        return view('feedback.edit')->with('feedback', $feedback);
    }

    /**
     * Update the specified feedback in storage.
     *
     * @param int $id
     * @param UpdatefeedbackRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefeedbackRequest $request)
    {
        $feedback = $this->feedbackRepository->find($id);

        if (empty($feedback)) {
            Flash::error('Feedback not found');

            return redirect(route('feedback.index'));
        }

        $feedback = $this->feedbackRepository->update($request->all(), $id);

        Flash::success('Feedback updated successfully.');

        return redirect(route('feedback.index'));
    }

    /**
     * Remove the specified feedback from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feedback = $this->feedbackRepository->find($id);

        if (empty($feedback)) {
            Flash::error('Feedback not found');

            return redirect(route('feedback.index'));
        }

        $this->feedbackRepository->delete($id);

        Flash::success('Feedback deleted successfully.');

        return redirect(route('feedback.index'));
    }
}
