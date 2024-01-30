<?php

declare(strict_types=1);

namespace Card;

use App\Models\Card;

class CardStore
{
    private string $bindingId;
    private string $pan;
    private string $cardholderName;

    public function __construct(string $bindingId, string $pan, string $cardholderName)
    {
        $this->bindingId = $bindingId;
        $this->pan = $pan;
        $this->cardholderName = $cardholderName;
    }

    public function __invoke(): Card
    {
        $card = new Card();
        $card->binding_id = $this->bindingId;
        $card->pan = $this->pan;
        $card->cardholder_name = $this->cardholderName;
        $card->save();
        return $card;
    }
}
