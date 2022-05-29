<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertService
{



    public function save(Request $request)
    {
        $createUser = $request->has('create_user');
        $validated = $request->validate(
            [
                'name' => 'required|unique:accounts,accounts.name',
                'phone' => 'required',
                'email' => 'required|email|unique:accounts,accounts.email',
                'field' => 'required',
                'category' => 'required|in:main,certified,assistant,external,external-assistant',
            ]
        );

        $account = Account::updateOrCreate(['name' => $validated['name']], $validated);

        $expert = Expert::updateOrCreate(['account_id' => $account->id], $validated);

        $account->expert()->save($expert);
    }
}
