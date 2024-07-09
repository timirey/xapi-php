<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\State;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the trade record data in the streaming response.
 */
class TradeStreamRecord
{
    /**
     * @var Cmd Operation code.
     */
    public Cmd $cmd;

    /**
     * @var State Trade state.
     */
    public State $state;

    /**
     * @var Type Trade type.
     */
    public Type $type;

    /**
     * @var DateTime|null Expiration timestamp.
     */
    public ?DateTime $expiration = null;

    /**
     * @var DateTime|null Close timestamp.
     */
    public ?DateTime $closeTime = null;

    /**
     * @var DateTime Open timestamp.
     */
    public DateTime $openTime;

    /**
     * @var float Open price.
     */
    public float $openPrice;

    /**
     * @var float Close price.
     */
    public float $closePrice;

    /**
     * @var float Margin rate.
     */
    public float $marginRate;

    /**
     * Constructor for the TradeStreamRecord class.
     *
     * @param  float        $close_price   Close price.
     * @param  integer|null $close_time    Close time.
     * @param  boolean      $closed        Closed status.
     * @param  integer      $cmd           Operation code.
     * @param  string       $comment       Comment.
     * @param  float        $commission    Commission.
     * @param  string       $customComment Custom comment.
     * @param  integer      $digits        Number of decimal places.
     * @param  integer|null $expiration    Expiration time.
     * @param  float        $margin_rate   Margin rate.
     * @param  integer      $offset        Trailing offset.
     * @param  float        $open_price    Open price.
     * @param  integer      $open_time     Open time.
     * @param  integer      $order         Order number.
     * @param  integer      $order2        Transaction ID.
     * @param  integer      $position      Position number.
     * @param  float        $profit        Profit.
     * @param  float        $sl            Stop loss.
     * @param  string       $state         Trade state.
     * @param  float        $storage       Storage.
     * @param  string       $symbol        Symbol.
     * @param  float        $tp            Take profit.
     * @param  integer      $type          Trade type.
     * @param  float        $volume        Volume in lots.
     */
    public function __construct(
        float $close_price,
        ?int $close_time,
        public bool $closed,
        int $cmd,
        public string $comment,
        public float $commission,
        public string $customComment,
        public int $digits,
        ?int $expiration,
        float $margin_rate,
        public int $offset,
        float $open_price,
        int $open_time,
        public int $order,
        public int $order2,
        public int $position,
        public float $profit,
        public float $sl,
        string $state,
        public float $storage,
        public string $symbol,
        public float $tp,
        int $type,
        public float $volume,
    ) {
        $this->cmd = Cmd::from($cmd);
        $this->state = State::from($state);
        $this->type = Type::from($type);

        $this->openTime = DateTimeHelper::fromMilliseconds($open_time);

        if ($close_time !== null) {
            $this->closeTime = DateTimeHelper::fromMilliseconds($close_time);
        }

        if ($expiration !== null) {
            $this->expiration = DateTimeHelper::fromMilliseconds($expiration);
        }

        $this->openPrice = $open_price;
        $this->closePrice = $close_price;
        $this->marginRate = $margin_rate;
    }
}
