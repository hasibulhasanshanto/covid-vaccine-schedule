<?php

namespace App\Services;

use DB;
use Exception;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\VaccinationRegistration;

class UserService
{

    protected $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(Request $request, array $data)
    {
        try {
            DB::beginTransaction();
            unset($data['vaccine_center_id']);
            $user = User::create($data);

            $register = new Registration();
            $register->user_id = $user->id;
            $register->vaccine_center_id = $request->vaccine_center_id;
            $register->save();

            $messages = [
                'cong' => 'Congratulations! ' . $user->full_name,
                'body' => 'You\'re successfully registered at COVID Vaccination program. We will send date to get your vaccination shortly.',
            ];

            $user->notify(new VaccinationRegistration($messages));
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollback();
            Log::info('Something went wrong- ' . $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param Model $model
     * @return void
     */
    public function update(array $data, Model $model)
    {
        try {
            return $model->update($data);
        } catch (Exception $e) {
            Log::info('Something went wrong- ' . $e->getMessage());
        }
    }
}
