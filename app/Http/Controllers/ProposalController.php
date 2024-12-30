<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Submission;
use App\Models\Student;

class ProposalController extends Controller
{
    public function create()
    {
        return view('proposals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:students,id',
        ]);

        $proposal = Proposal::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'mahasiswa_id' => $request->mahasiswa_id,
        ]);

        return redirect()->route('proposals.index');
    }

    public function submit(Proposal $proposal)
    {
        $submission = new Submission();
        $submission->proposal_id = $proposal->id;
        $submission->save();

        return redirect()->route('proposals.index');
    }

    public function review(Submission $submission, $status)
    {
        $submission->status = $status;
        $submission->save();

        return redirect()->route('admin.dashboard');
    }

    public function index()
    {
        $proposals = Proposal::all();
        return view('proposals.index', compact('proposals'));
    }
}

