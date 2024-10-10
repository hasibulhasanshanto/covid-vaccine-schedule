<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use App\Services\UserService;
use App\Http\Requests\UserVaccineRegisterRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{/**
     * Service dependency injection with constructor property promotion
     */
    public function __construct(protected UserService $userService){}

    /**
     * Show the home page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home');
    }

    /**
     * Show the search page.
     *
     * @return \Inertia\Response
     */
    public function search(Request $request): Response
    {
        $user = User::with('registration:id,user_id,status,scheduled_date')->whereNid($request->nid)->first();
        return Inertia::render('Search', [
            'user' => $user,
            'paramsObj' => $request ?? null,
        ]);
    }

    /**
     * Show the registration page.
     *
     * @return \Inertia\Response
     */
    public function showRegistration(): Response
    {
        $centers = VaccineCenter::all();

        return Inertia::render('Registration', [
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
        $validated = $request->validated();
        $this->userService->store($request, $validated);
        session()->flash('success', 'Registration successful!');
        return redirect()->route('home');
    }
}
