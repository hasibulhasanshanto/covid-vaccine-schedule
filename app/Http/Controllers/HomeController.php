<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserVaccineRegisterRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Home');
    }

    /**
     * Show the search page.
     *
     * @return \Inertia\Response
     */
    public function search(): Response
    {
        return Inertia::render('Search');
    }

    /**
     * Show the registration page.
     *
     * @return \Inertia\Response
     */
    public function showRegistration(): Response
    {
        $centers = VaccineCenter::all();

        return Inertia::render('Registration',[
            'centers' => $centers
        ]);
    }


    /**
     * Store the user's registration information.
     *
     * @param  \App\Http\Requests\UserVaccineRegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRegistration(UserVaccineRegisterRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            unset($validated['vaccine_center_id']);
            $validated['registered_at'] = now();
            $user = User::create($validated);

            $register = new Registration();
            $register->user_id = $user->id;
            $register->vaccine_center_id = $request->vaccine_center_id;
            $register->save();

            session()->flash('success', 'Registration successful!');
            return redirect()->route('home');
        } catch (Exception $e) {
            Log::info('Something went wrong- '. $e->getMessage());
        }
        return back();
    }
}
