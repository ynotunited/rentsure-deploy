<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Upload a document.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'type' => 'required|string|in:live_photo,rental_document,id_document,proof_of_income,other',
            'document' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
        ]);
        
        $file = $request->file('document');
        
        // Store the file
        $path = $file->store('documents/' . $user->id, 'public');
        
        // Create document record
        $document = Document::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'status' => 'pending',
        ]);
        
        return redirect()->back()
            ->with('success', 'Document uploaded successfully and pending verification.');
    }

    /**
     * Verify a document (for admins).
     *
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Document $document)
    {
        $admin = Auth::user();
        
        // Verify that the user is an admin
        if (!$admin->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Only admins can verify documents.');
        }
        
        // Verify the document
        $document->verify();
        
        return redirect()->back()
            ->with('success', 'Document verified successfully.');
    }
}
