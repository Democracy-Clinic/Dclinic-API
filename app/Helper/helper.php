    <?php

if (! function_exists('words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function words($value, $words = 100, $end = '...')
    {
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}

function numformat($value, $type = null)
{

    if ($type == null) {
        $formatter = NumberFormatter::PATTERN_DECIMAL;
    }
    if ($type == 'percent') {
        $formatter = NumberFormatter::PERCENT;
    }
    if ($type == 'currency') {
        $formatter = NumberFormatter::CURRENCY;
    }
    $numberFormatter = new NumberFormatter('my', $formatter);
    $num = $numberFormatter->format($value);
    return $num;
}

function numdate($value)
{
    $year = date(('Y'), strtotime($value));
    $day = date(('d'), strtotime($value));
    $month = date(('m'), strtotime($value));
    return numformat($day) . '-' . numformat($month) . '-' . numformat($year);
}
