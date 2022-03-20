<?php

namespace App\Jobs;

use App\Models\Matter;
use App\Services\MatterService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\Session\Session;
use Throwable;

class CreateMatter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $data;
    protected $matter;
    protected $service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->service = (new MatterService());
        $this->data = $this->service->resolve($data);
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

                $this->matter = Matter::create($this->data->get('matter'));

                if ($this->data->has('claims')) {

                    $this->matter->claims()->saveMany(
                        $this->data->get('claims')
                    );
                }

                if ($this->data->has('parties')) {

                    $this->matter->parties()->sync(
                        $this->data->get('parties')
                    );
                }

                if ($this->data->has('marketing')) {

                    $this->matter->marketers()->sync(
                        $this->data->get('marketing')
                    );
                }

                if ($this->data->has('procedures')) {

                    $this->matter->procedures()->saveMany(
                        $this->data->get('procedures')
                    );
                }
            });
            session()->flash('last_inserted_matter',$this->matter);
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
