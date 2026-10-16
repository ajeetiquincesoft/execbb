<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /*   public function index(Request $request)
    {
        $query = $request->input('query');
        $contacts = DB::table('contacts')
            ->join('contact_types', 'contact_types.Type', '=', 'contacts.Type')
            ->select('contacts.*', 'contact_types.Description')
            ->where('contact_types.Description', 'like', '%' . $query . '%')
            ->orWhere('contacts.ContactID', 'like', '%' . $query . '%')
            ->orWhere('contacts.FName', 'like', '%' . $query . '%')
            ->orWhere('contacts.LName', 'like', '%' . $query . '%')
            ->orWhere('contacts.CompanyName', 'like', '%' . $query . '%')
            ->orWhere('contacts.Phone', 'like', '%' . $query . '%')
            ->orWhere('contacts.Email', 'like', '%' . $query . '%')
            ->orderBy('contacts.created_at', 'desc')
            ->paginate(10);
        $contact_type = DB::table('contact_types')->pluck('Description', 'Type');
        return view('admin.contact.index', compact('contacts', 'contact_type'));
    } */
    public function index(Request $request)
    {
        $query = trim($request->input('query', ''));
        $sort = $request->input('sort', 'ContactID');
        $direction = strtolower($request->input('direction', 'desc'));

        $allowedSortColumns = [
            'ContactID' => 'contacts.ContactID',
            'FName'     => 'contacts.FName',
            'CompanyName'     => 'contacts.CompanyName',

        ];

        if (!array_key_exists($sort, $allowedSortColumns)) {
            $sort = 'ContactID';
        }

        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        $contacts = DB::table('contacts')
            ->leftJoin(
                'contact_types',
                'contact_types.Type',
                '=',
                'contacts.Type'
            )
            ->select('contacts.*', 'contact_types.Description');

        if ($query !== '') {
            $contacts->where(function ($q) use ($query) {
                $q->where('contact_types.Description', 'like', "%{$query}%")
                    ->orWhere('contacts.ContactID', 'like', "%{$query}%")
                    ->orWhere('contacts.FName', 'like', "%{$query}%")
                    ->orWhere('contacts.LName', 'like', "%{$query}%")
                    ->orWhere('contacts.CompanyName', 'like', "%{$query}%")
                    ->orWhere('contacts.Phone', 'like', "%{$query}%")
                    ->orWhere('contacts.Email', 'like', "%{$query}%");
            });
        }

        // Apply sorting
        if ($sort === 'FName') {
            $contacts->orderByRaw("
            CASE
                WHEN TRIM(CONCAT(
                    COALESCE(contacts.FName, ''),
                    ' ',
                    COALESCE(contacts.LName, '')
                )) = '' THEN 1
                ELSE 0
            END ASC
        ");

            $contacts->orderByRaw(
                "LOWER(TRIM(COALESCE(contacts.FName, ''))) {$direction}"
            );

            $contacts->orderByRaw(
                "LOWER(TRIM(COALESCE(contacts.LName, ''))) {$direction}"
            );
        } elseif ($sort === 'CompanyName') {
            $contacts->orderByRaw("
        CASE
            WHEN TRIM(COALESCE(contacts.CompanyName, '')) = ''
            THEN 1
            ELSE 0
        END ASC
    ");

            $contacts->orderByRaw(
                "LOWER(TRIM(COALESCE(contacts.CompanyName, ''))) {$direction}"
            );
        } else {
            $contacts->orderBy($allowedSortColumns[$sort], $direction);
        }

        if ($sort !== 'ContactID') {
            $contacts->orderBy('contacts.ContactID', 'desc');
        }

        $contacts = $contacts
            ->paginate(10)
            ->appends($request->except('page'));

        $contact_type = DB::table('contact_types')
            ->pluck('Description', 'Type');

        return view(
            'admin.contact.index',
            compact('contacts', 'contact_type')
        );
    }
    public function create()
    {
        $states = DB::table('states')->get();
        $contact_types = DB::table('contact_types')->get();
        return view('admin.contact.create', compact('states', 'contact_types'));
    }
    public function processForm(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'type' => 'required',
        ]);
        $contact = new contact;
        $contact->FName = $request->first_name;
        $contact->LName = $request->last_name;
        $contact->CompanyName  = $request->company;
        $contact->AddRep = $request->addlContact;
        $contact->Address1 = $request->address;
        $contact->City = $request->city;
        $contact->State = $request->contact_state;
        $contact->Zip = $request->zip;
        $contact->Phone = $request->phone;
        $contact->Fax = $request->fax;
        $contact->Pager = $request->pager;
        $contact->Email = $request->email;
        $contact->Type = $request->type;
        $contact->Comments = $request->comments;
        $contact->save();
        Activity::create([
            'action' => 'Contact add',
            'user_id' => Auth::id(),
            'details' => 'created a new contact with email: ' . $request->email,
        ]);
        return redirect()->route('all.contact')->with('success', 'Your contact create successfully!');
    }
    public function editContact(Request $request, $id)
    {
        $contact = Contact::where('ContactID', $id)->first();
        if (!$contact) {
            return redirect()->route('all.contact')
                ->with('err_message', 'Contact not found.');
        }
        $states = DB::table('states')->get();
        $contact_types = DB::table('contact_types')->get();
        // Get the previous contact ID
        $previous = Contact::where('ContactID', '<', $id)->orderBy('ContactID', 'desc')->first();
        // Get the next contact ID
        $next = Contact::where('ContactID', '>', $id)->orderBy('ContactID', 'asc')->first();
        return view('admin.contact.edit', compact('states', 'contact_types', 'contact', 'previous', 'next'));
    }
    public function editProcessForm(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'type' => 'required',
        ]);
        $contact = Contact::where('ContactID', $id)->first();
        $contact->FName = $request->first_name;
        $contact->LName = $request->last_name;
        $contact->CompanyName  = $request->company;
        $contact->AddRep = $request->addlContact;
        $contact->Address1 = $request->address;
        $contact->City = $request->city;
        $contact->State = $request->contact_state;
        $contact->Zip = $request->zip;
        $contact->Phone = $request->phone;
        $contact->Fax = $request->fax;
        $contact->Pager = $request->pager;
        $contact->Email = $request->email;
        $contact->Type = $request->type;
        $contact->Comments = $request->comments;
        $contact->save();
        Activity::create([
            'action' => 'Contact update',
            'user_id' => Auth::id(),
            'details' => 'update contact with email: ' . $request->email,
        ]);
        return redirect()->route('all.contact')->with('success', 'Your contact update successfully!');
    }
    public function show($id)
    {
        $contact = Contact::where('ContactID', $id)->first();
        if (!$contact) {
            return back()->with('error', 'Contact not found!');
        }
        $activities = Activity::latest()->paginate(10);
        // Get the previous contact ID
        $previous = Contact::where('ContactID', '<', $id)->orderBy('ContactID', 'desc')->first();
        // Get the next contact ID
        $next = Contact::where('ContactID', '>', $id)->orderBy('ContactID', 'asc')->first();
        $contact_type = DB::table('contact_types')->pluck('Description', 'Type');

        return view('admin.contact.show', compact('contact', 'previous', 'next', 'contact_type', 'activities'));
    }
    public function destroy(Request $request, $id)
    {

        // Find the contact ID
        $contact = Contact::where('ContactID', $id)->first();
        // Check if the contact exists
        if (!$contact) {
            return redirect()->route('all.contact')
                ->with('err_message', 'Contact not found.');
        }
        Activity::create([
            'action' => 'Contact delete',
            'user_id' => Auth::id(),
            'details' => 'deleted a contact of email: ' . $contact->Email,
        ]);
        // Delete the contact
        Contact::where('ContactID', $id)->delete();

        return redirect()->route('all.contact')
            ->with('success', 'Contact deleted successfully.');
    }
}
