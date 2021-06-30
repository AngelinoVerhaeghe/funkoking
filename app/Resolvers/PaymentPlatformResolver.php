<?php

namespace App\Resolvers;

use App\PaymentPlatform;

class PaymentPlatformResolver
{
    protected $paymentPlatforms;

    public function __construct()
    {
        //Alle betaling gateway uit database halen
        $this->paymentPlatforms = PaymentPlatform::all();
    }

    public function resolveService($paymentPlatformId)
    {

        //Naam van het platform ophalen
        $name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name);

        //Service aanspreken vanuit de config, {$name} variable en tussen dubbele quotes
        $service = config("services.{$name}.class");

        if ($service) {
            return resolve($service);
        }

        //Indien er een fout is
        throw new \Exception('The selected platform is not in the configuration');

    }
}
