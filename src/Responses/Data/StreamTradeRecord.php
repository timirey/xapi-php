<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\State;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Helpers\DateTimeHelper;
use DateTime;

/**
 * Class representing the trade record data in the streaming response.
 */
class StreamTradeRecord
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
    public ?DateTime $expiration;

    /**
     * @var DateTime|null Close timestamp.
     */
    public ?DateTime $close_time;

    /**
     * @var DateTime Open timestamp.
     */
    public DateTime $open_time;

    /**
     * Constructor for the StreamTradeRecord class.
     *
     * @param float    $close_price   Close price.
     * @param int|null $close_time    Close time.
     * @param bool     $closed        Closed status.
     * @param int      $cmd           Operation code.
     * @param string   $comment       Comment.
     * @param float    $commission    Commission.
     * @param string   $customComment Custom comment.
     * @param int      $digits        Number of decimal places.
     * @param int|null $expiration    Expiration time.
     * @param float    $margin_rate   Margin rate.
     * @param int      $offset        Trailing offset.
     * @param float    $open_price    Open price.
     * @param int      $open_time     Open time.
     * @param int      $order         Order number.
     * @param int      $order2        Transaction ID.
     * @param int      $position      Position number.
     * @param float    $profit        Profit.
     * @param float    $sl            Stop loss.
     * @param string   $state         Trade state.
     * @param float    $storage       Storage.
     * @param string   $symbol        Symbol.
     * @param float    $tp            Take profit.
     * @param int      $type          Trade type.
     * @param float    $volume        Volume in lots.
     */
    public function __construct(
        public float $close_price, //todo: change everything to camel case close_price -> closePrice
        ?int $close_time,
        public bool $closed,
        int $cmd,
        public string $comment,
        public float $commission,
        public string $customComment,
        public int $digits,
        ?int $expiration,
        public float $margin_rate,
        public int $offset,
        public float $open_price,
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

        $this->open_time = DateTimeHelper::fromMilliseconds($open_time);

        if ($close_time !== null) {
            $this->close_time = DateTimeHelper::fromMilliseconds($close_time);
        }

        if ($expiration !== null) {
            $this->expiration = DateTimeHelper::fromMilliseconds($expiration);
        }
    }
}
