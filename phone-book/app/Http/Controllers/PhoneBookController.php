<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use App\Http\Requests\PhoneBookRequest;
use Illuminate\Http\Request;
use Response;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactList = PhoneBook::orderBy('name', 'asc')->get();
        
        if($contactList->isEmpty()) {
            return response()->json([
                'message' => 'No contacts found',
                'data' => [],
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Phone contact list',
            'data' => $contactList,
            'status' => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhoneBookRequest $request)
    {
        $validatedData = $request->validated();

        // Additional unique validation for contact_number
        $request->validate([
            'contact_number' => 'unique:phone_books,contact_number',
        ], [
            'contact_number.unique' => 'Contact number already exists',
        ]);

        $newContact = PhoneBook::create($validatedData);

        return response()->json([
            'message' => 'New Contact has been successfully saved.',
            'data' => $newContact,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhoneBook $contact)
    {
        return response()->json([
            'status' => 200,
            'data' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhoneBook $phoneBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhoneBookRequest $request, $contactId)
    {
        try {
            $contact = PhoneBook::findOrFail($contactId);
            $validatedData = $request->validated();

            if ($contact->contact_number !== $validatedData['contact_number']) {
                $request->validate([
                    'contact_number' => [
                        'unique:phone_books,contact_number',
                    ],
                ], [
                    'contact_number.unique' => 'Contact number already exists',
                ]);
            }

            $contact->name = $validatedData['name'];
            $contact->contact_number = $validatedData['contact_number'];
            $contact->save();

            return response()->json([
                'message' => 'Contact updated successfully.',
                'data' => $contact,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update contact.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneBook $contact)
    {
        try {
            $contact->delete();
            return response()->json(['status' => 200, 'message' => 'Contact successfully deleted', 'data' => []]);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'message' => 'Unable to delete contact: ' . $e->getMessage(), 'data' => []]);
        }
    }
}
