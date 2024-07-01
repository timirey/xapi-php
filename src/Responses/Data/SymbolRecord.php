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
class SymbolRecord
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
    public ?DateTime $expiration = null;

    /**
     * @var DateTime|null Starting time, null if not applicable.
     */
    public ?DateTime $starting = null;

    /**
     * @var DateTime Ask & bid tick time.
     */
    public DateTime $time;

    /**
     * Constructor for SymbolRecord.
     *
     * @param string $symbol Symbol name.
     * @param string $currency Currency.
     * @param string $categoryName Category name.
     * @param string $currencyProfit The currency of calculated profit.
     * @param int $quoteId Source of price.
     * @param int $quoteIdCross Cross quote ID.
     * @param int $marginMode For margin calculation.
     * @param int $profitMode For profit calculation.
     * @param int $pipsPrecision Number of symbol's pip decimal places.
     * @param int $contractSize Size of 1 lot.
     * @param int $exemode Execution mode.
     * @param int $time Ask & bid tick time.
     * @param int|null $expiration Expiration time, null if not applicable.
     * @param int $stopsLevel Min distance (in pips) from the current price where the stopLoss/takeProfit can be set.
     * @param int $precision Number of symbol's price decimal places.
     * @param int $swapType Type of swap calculated.
     * @param int $stepRuleId Appropriate step rule ID from getStepRules command response.
     * @param int $type Instrument class number.
     * @param int $instantMaxVolume Maximum instant volume multiplied by 100 (in lots).
     * @param string $groupName Symbol group name.
     * @param string $description Description.
     * @param bool $longOnly Indicates if the symbol is long only.
     * @param bool $trailingEnabled Indicates whether trailing stop (offset) is applicable to the instrument.
     * @param bool $marginHedgedStrong For margin calculation.
     * @param bool $swapEnable Indicates whether swap value is added to position on end of day.
     * @param float $percentage Percentage.
     * @param float $bid Bid price in base currency.
     * @param float $ask Ask price in base currency.
     * @param float $high The highest price of the day in base currency.
     * @param float $low The lowest price of the day in base currency.
     * @param float $lotMin Minimum size of trade.
     * @param float $lotMax Maximum size of trade.
     * @param float $lotStep Min step by which the size of trade can be changed (within lotMin - lotMax range).
     * @param float $tickSize Smallest possible price change, used for profit/margin calculation.
     * @param float $tickValue Smallest possible price change (in base currency), used for profit/margin calculation.
     * @param float $swapLong Swap value for long positions in pips.
     * @param float $swapShort Swap value for short positions in pips.
     * @param float $leverage Symbol leverage.
     * @param float $spreadRaw The difference between raw ask and bid prices.
     * @param float $spreadTable Spread representation.
     * @param int|null $starting Starting time, null if not applicable.
     * @param int $swap_rollover3days Time when additional swap is accounted for weekend.
     * @param int|null $marginMaintenance For margin calculation, null if not applicable.
     * @param int $marginHedged Used for profit calculation.
     * @param int $initialMargin Initial margin for 1 lot order, used for profit/margin calculation.
     * @param string $timeString Time in string format.
     * @param bool $shortSelling Indicates whether short selling is allowed on the instrument.
     * @param bool $currencyPair Indicates whether the symbol represents a currency pair.
     */
    public function __construct(
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
        public int $swap_rollover3days,
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

        $this->time = DateTimeHelper::createFromMilliseconds($time);

        if ($expiration !== null) {
            $this->expiration = DateTimeHelper::createFromMilliseconds($expiration);
        }

        if ($starting !== null) {
            $this->starting = DateTimeHelper::createFromMilliseconds($starting);
        }
    }
}
