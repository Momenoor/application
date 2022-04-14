<?php

namespace App\Jobs;

use App\Models\Matter;
use App\Services\MatterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Throwable;

class CreateMatter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $data;
    protected $matter;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (new MatterService())->resolve($data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            \DB::transaction(function () {

                $this->matter = Matter::create($this->data['matter']);

                if (Arr::has($this->data, 'claims')) {

                    $this->matter->claims()->saveMany(
                        data_get($this->data, 'claims')
                    );
                }

                if (Arr::has($this->data, 'parties')) {

                    $this->matter->parties()->sync(
                        data_get($this->data, 'parties')
                    );
                }

                if (Arr::has($this->data, 'experts')) {

                    $this->matter->experts()->sync(
                        data_get($this->data, 'experts')
                    );
                }

                if (Arr::has($this->data, 'marketing')) {

                    $this->matter->marketers()->sync(
                        data_get($this->data, 'marketing')
                    );
                }

                if (Arr::has($this->data, 'procedures')) {

                    $this->matter->procedures()->saveMany(
                        data_get($this->data, 'procedures')
                    );
                }
            });
            session()->flash('last_inserted_matter', $this->matter);
        } catch (Throwable $ex) {

            dd($ex);
            return false;
        }
    }

    public function getInserted(): Matter
    {
        return $this->matter;
    }
}
