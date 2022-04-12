<?php

namespace App\Services;

use App\Models\Claim;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Procedure;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class MatterService
{

    protected $with = [
        'expert',
        'claims',
        'cashes',
        'court',
        'type',
        'assistants',
        'plaintiffs',
        'defendants',
        'cashes',
    ];

    protected $query;

    public function __construct()
    {
        $this->query = Matter::query();
    }


    public static function resolve($data): Collection
    {
        $matter = [];

        if (key_exists('matter', $data)) {
            $matter['matter'] = $data['matter'];
        }

        if (key_exists('claims', $data)) {
            $claims = [];
            foreach ($data['claims'] as $claim) {
                $claims[] = new Claim([
                    'type' => $claim['type']['name'],
                    'amount' => $claim['amount'],
                    'recurring' => $claim['recurring']['name'],
                ]);
            }
            $matter['claims'] = $claims;
        }


        if (key_exists('parties', $data)) {


            $matter['experts'] = [];

            $partiesDef = config('system.parties.type');
            $parties = [];
            foreach ($data['parties'] as $party) {

                if ($partiesDef[$party['type']]['model'] == Expert::class) {
                    $matter['experts'][$party['name']] = ['type' => $party['type']];
                } else {

                    $firstOrCreate = [
                        'name' => $party['name'],
                        'phone' => $party['phone'] ?? null,
                        'email' => $party['email'] ?? null,
                        'type' => 'party',
                    ];

                    $dbParty = Party::firstOrCreate($firstOrCreate);

                    $parties[$dbParty->id] = ['type' => $party['type']];
                    if (key_exists('subParties', $party)) {

                        if (!is_array($party['subParties'])) {

                            return false;
                        }

                        foreach ($party['subParties'] as $subparty) {
                            $parties[$subparty] = [
                                'parent_id' => $dbParty->id,
                                'type' => $party['type'] . '_advocate'
                            ];
                        }
                    }
                    $matter['parties'] = $parties;
                }
            }
        }

        if (key_exists('committee', $matter['matter'])) {

            $parties = [];

            if (!is_array($matter['matter']['committee'])) {
                $matter['matter']['committee'] = [$matter['matter']['committee']];
            }
            foreach ($matter['matter']['committee'] as $party) {
                $parties[$party] = ['type' => 'committee'];
            }
            array_push($matter['experts'], $parties);
            unset($matter['committee']);
        }

        if (key_exists('marketing', $data)) {

            $marketing = [];
            foreach ($data['marketing'] as $party) {

                $marketing[$party['id']] = ['type' => $party['type']];
            }
            $matter['marketing'] = $marketing;
        }



        $matter['procedures'] = [
            new Procedure([
                'type' => 'received_date',
                'datetime' => $data['matter']['received_date'],
                'discription' => 'received_date',
            ]),
            new Procedure([
                'type' => 'next_session_date',
                'datetime' => $data['matter']['next_session_date'],
                'discription' => 'next_session_date',
            ]),
        ];
        dd($matter);
        return collect($matter);
    }

    public static function partiesResolve(Matter $matter)
    {
        $newPrties = [];
        $parties = $matter->parties;
        foreach ($parties as $party) {

            $party->color = config('system.parties.type.' . $party->pivot->type . '.color');
            $newPrties[$party->id] = $party->toArray();
            if ($party->pivot->parent_id != 0) {

                $newPrties[$party->pivot->parent_id]['subparty'][$party->id] = $party;
                unset($newPrties[$party->id]);
            }
        }

        return $newPrties;
    }

    public static function getMatterWithRelations(Matter $matter, $related = null)
    {
        if (is_null($related)) {
            $related = self::$with;
        }
        if (!is_array($related)) {
            $related = [$related];
        }
        if (is_array($related) && count($related) > 0) {
            $matter->with('');
        }
    }

    public function setFilters($request)
    {
        if ($request->get('court') != null && $request->get('court') != 'all') {
            $this->query->whereRelation('court', 'courts.id', '=', $request->get('court'));
        }

        if ($request->get('expert') != null && $request->get('expert') != 'all') {
            $this->query->whereRelation('expert', 'experts.id', '=', $request->get('expert'));
        }

        if ($request->get('type') != null && $request->get('type') != 'all') {
            $this->query->whereRelation('type', 'types.id', '=', $request->get('type'));
        }

        if ($request->get('assistant') != null && $request->get('assistant') != 'all') {
            $this->query->whereRelation('assistants', 'experts.id', '=', $request->get('assistant'));
        }

        if ($request->get('start_date') != null) {
            $this->query->where('matters.' . $request->get('start_date_type'), '>=', $request->get('start_date'));
        }

        if ($request->get('end_date') != null) {
            $this->query->where('matters.' . $request->get('end_date_type'), '<=', $request->get('end_date'));
        }

        if (count($request->get('matterStatus')) > 0) {
            $this->query->whereIn('matters.status', $request->get('matterStatus'));
        }

        if ($request->get('category') != null && $request->get('category') != 'all') {
            $mainExpert = config('system.experts.main');
            if ($request->get('category') == 'private') {
                $this->query->whereNotIn('expert_id', $mainExpert);
            } else if ($request->get('category') == 'office') {
                $this->query->whereIn('expert_id', $mainExpert);
            }
        }

        if (count($request->get('claimsCollectionStatus')) > 0) {
        }

        return $this;
    }

    public function getForExcel()
    {
        $this->query->with($this->with);

        return $this->query;
    }
}
