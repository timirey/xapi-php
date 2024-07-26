<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\MarginMode;
use Timirey\XApi\Enums\ProfitMode;
use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a symbol record.
 */
readonly class SymbolRecord
{
    /**
     * @var QuoteId Source of price.
     */
    public QuoteId $quoteId;

    /**
     * @var MarginMode For margin calculation.
     */
    public MarginMode $marginMode;

    /**
     * @var ProfitMode For profit calculation.
     */
    public ProfitMode $profitMode;

    /**
     * @var DateTime|null Expiration time, null if not applicable.
     */
    public ?DateTime $expiration;

    /**
     * @var DateTime|null Starting time, null if not applicable.
     */
    public ?DateTime $starting;

    /**
     * @var DateTime Ask & bid tick time.
     */
    public DateTime $time;

    /**
     * @var integer Time when additional swap is accounted for weekend.
     */
    public int $swapRollover3Days;

    /**
     * Constructor for SymbolRecord.
     *
     * @param  string       $symbol             Symbol name.
     * @param  string       $currency           Currency.
     * @param  string       $categoryName       Category name.
     * @param  string       $currencyProfit     The currency of calculated profit.
     * @param  integer      $quoteId            Source of price.
     * @param  integer      $quoteIdCross       Cross quote ID.
     * @param  integer      $marginMode         For margin calculation.
     * @param  integer      $profitMode         For profit calculation.
     * @param  integer      $pipsPrecision      Number of symbol's pip decimal places.
     * @param  integer      $contractSize       Size of 1 lot.
     * @param  integer      $exemode            Unknown, not documented.
     * @param  integer      $time               Ask & bid tick time.
     * @param  integer|null $expiration         Expiration time, null if not applicable.
     * @param  integer      $stopsLevel         Min distance from the current price where the sl/tp can be set.
     * @param  integer      $precision          Number of symbol's price decimal places.
     * @param  integer      $swapType           Type of swap calculated.
     * @param  integer      $stepRuleId         Appropriate step rule ID from getStepRules command response.
     * @param  integer      $type               Instrument class number.
     * @param  integer      $instantMaxVolume   Maximum instant volume multiplied by 100 (in lots).
     * @param  string       $groupName          Symbol group name.
     * @param  string       $description        Description.
     * @param  boolean      $longOnly           Indicates if the symbol is long only.
     * @param  boolean      $trailingEnabled    Indicates whether trailing stop is applicable to the instrument.
     * @param  boolean      $marginHedgedStrong For margin calculation.
     * @param  boolean      $swapEnable         Indicates whether swap value is added to position on end of day.
     * @param  float        $percentage         Percentage.
     * @param  float        $bid                Bid price in base currency.
     * @param  float        $ask                Ask price in base currency.
     * @param  float        $high               The highest price of the day in base currency.
     * @param  float        $low                The lowest price of the day in base currency.
     * @param  float        $lotMin             Minimum size of trade.
     * @param  float        $lotMax             Maximum size of trade.
     * @param  float        $lotStep            Min step by which the size of trade can be changed.
     * @param  float        $tickSize           Smallest possible price change.
     * @param  float        $tickValue          Smallest possible price change (in base currency).
     * @param  float        $swapLong           Swap value for long positions in pips.
     * @param  float        $swapShort          Swap value for short positions in pips.
     * @param  float        $leverage           Symbol leverage.
     * @param  float        $spreadRaw          The difference between raw ask and bid prices.
     * @param  float        $spreadTable        Spread representation.
     * @param  integer|null $starting           Starting time, null if not applicable.
     * @param  integer      $swap_rollover3days Time when additional swap is accounted for weekend.
     * @param  integer|null $marginMaintenance  For margin calculation, null if not applicable.
     * @param  integer      $marginHedged       Used for profit calculation.
     * @param  integer      $initialMargin      Initial margin for 1 lot order, used for profit/margin calculation.
     * @param  string       $timeString         Time in string format.
     * @param  boolean      $shortSelling       Indicates whether short selling is allowed on the instrument.
     * @param  boolean      $currencyPair       Indicates whether the symbol represents a currency pair.
     */
    final public function __construct(
        public string $symbol,
        public string $currency,
        public string $categoryName,
        public string $currencyProfit,
        int $quoteId,
        public int $quoteIdCross,
        int $marginMode,
        int $profitMode,
        public int $pipsPrecision,
        public int $contractSize,
        public int $exemode,
        int $time,
        ?int $expiration,
        public int $stopsLevel,
        public int $precision,
        public int $swapType,
        public int $stepRuleId,
        public int $type,
        public int $instantMaxVolume,
        public string $groupName,
        public string $description,
        public bool $longOnly,
        public bool $trailingEnabled,
        public bool $marginHedgedStrong,
        public bool $swapEnable,
        public float $percentage,
        public float $bid,
        public float $ask,
        public float $high,
        public float $low,
        public float $lotMin,
        public float $lotMax,
        public float $lotStep,
        public float $tickSize,
        public float $tickValue,
        public float $swapLong,
        public float $swapShort,
        public float $leverage,
        public float $spreadRaw,
        public float $spreadTable,
        ?int $starting,
        int $swap_rollover3days,
        public ?int $marginMaintenance,
        public int $marginHedged,
        public int $initialMargin,
        public string $timeString,
        public bool $shortSelling,
        public bool $currencyPair
    ) {
        $this->quoteId = QuoteId::from($quoteId);
        $this->marginMode = MarginMode::from($marginMode);
        $this->profitMode = ProfitMode::from($profitMode);

        $this->time = DateTimeHelper::fromMilliseconds($time);

        $this->expiration = $expiration !== null ? DateTimeHelper::fromMilliseconds($expiration) : null;
        $this->starting = $starting !== null ? DateTimeHelper::fromMilliseconds($starting) : null;

        $this->swapRollover3Days = $swap_rollover3days;
    }
}
