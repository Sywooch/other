<?php

class CallStatistics
{
    /**
     * @var OTAPILib
     */
    protected $otapilib;

    /**
     * @param OTAPILib $otapilib
     */
    public function __construct($otapilib)
    {
        $this->otapilib = $otapilib;
    }

    /**
     * @param $data
     * @return array
     */
    private function prepareCallStatistic($data)
    {
        $result = array();

        $result['OtapiAllCallStatistics'] = $this->prepareNodeStatistic($data, 'OtapiAllCallStatistics');
        $result['OtapiCallStatistics'] = $this->prepareNodeStatistic($data, 'OtapiCallStatistics');
        $result['TotalLengthTranslatedTexts'] = $this->prepareNodeStatistic($data, 'TotalLengthTranslatedTexts');
        $result['LengthExternalTranslatedTexts'] = $this->prepareNodeStatistic($data, 'LengthExternalTranslatedTexts');

        $cachedAdapter = $data['CachedAdapterCalltatistics'];
        $adapter = $data['AdapterCalltatistics'];
        if ($cachedAdapter['StatisticsByTimePeriod']['DailyCallCount'] != 0) {
            $result['CachedDailyCallCount'] = round(100-($adapter['StatisticsByTimePeriod']['DailyCallCount']/$cachedAdapter['StatisticsByTimePeriod']['DailyCallCount']), 2);
        } else {
            $result['CachedDailyCallCount'] = 0;
        }
        if ($cachedAdapter['StatisticsByTimePeriod']['MonthlyCallCount'] != 0) {
            $result['CachedMonthlyCallCount'] = round(100-($adapter['StatisticsByTimePeriod']['MonthlyCallCount']/$cachedAdapter['StatisticsByTimePeriod']['MonthlyCallCount']), 2);
        } else {
            $result['CachedMonthlyCallCount'] = 0;
        }        
        if ($cachedAdapter['TotalCount'] != 0) {
            $result['CachedTotalCount'] = round(100-($adapter['TotalCount']/$cachedAdapter['TotalCount']), 2);
        } else {
            $result['CachedTotalCount'] = 0;
        }
        return $result;
    }

    /**
     * @return array
     */
    private function prepareNodeStatistic($data, $node)
    {
        $statistic = array();

        $statistic['DailyCallCount'] = $data[$node]['StatisticsByTimePeriod']['DailyCallCount'];
        $statistic['MonthlyCallCount'] = $data[$node]['StatisticsByTimePeriod']['MonthlyCallCount'];
        $statistic['TotalCount'] = $data[$node]['TotalCount'];

        return $statistic;
    }

    public function getCallStatistics()
    {
        return $this->prepareCallStatistic($this->otapilib->GetCallStatistics());
    }
}
