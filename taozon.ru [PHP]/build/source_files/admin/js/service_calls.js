function getCount(){
    $.get('index.php', {cmd: 'ServiceCallCounter', do: 'getCount'},function(data){
        $('#CallCount').html(data.CallCount[0]);
        $('#DailyCallCount').html(data.DailyCallCount[0]);
        $('#MonthlyCallCount').html(data.MonthlyCallCount[0]);
        $('#WeeklyCallCount').html(data.WeeklyCallCount[0]);

        var totalTranslations = data.TotalLengthTranslatedTexts.StatisticsByTimePeriod;
        $('#TotalLengthTranslatedTextsDailyCallCount').html(totalTranslations.DailyCallCount[0]);
        $('#TotalLengthTranslatedTextsWeeklyCallCount').html(totalTranslations.WeeklyCallCount[0]);
        $('#TotalLengthTranslatedTextsMonthlyCallCount').html(totalTranslations.MonthlyCallCount[0]);
        $('#TotalLengthTranslatedTextsTotalCallCount').html(data.TotalLengthTranslatedTexts.TotalCount[0]);

        var totalTranslations = data.LengthExternalTranslatedTexts.StatisticsByTimePeriod;
        $('#LengthExternalTranslatedTextsDailyCallCount').html(totalTranslations.DailyCallCount[0]);
        $('#LengthExternalTranslatedTextsWeeklyCallCount').html(totalTranslations.WeeklyCallCount[0]);
        $('#LengthExternalTranslatedTextsMonthlyCallCount').html(totalTranslations.MonthlyCallCount[0]);
        $('#LengthExternalTranslatedTextsTotalCallCount').html(data.LengthExternalTranslatedTexts.TotalCount[0]);

        var cachedAdapter = data.CachedAdapterCalltatistics.StatisticsByTimePeriod;
        var adapter = data.AdapterCalltatistics.StatisticsByTimePeriod;

        if(adapter.DailyCallCount[0])
            $('#CachedDailyCallCount').html(
                100-(cachedAdapter.DailyCallCount[0]/adapter.DailyCallCount[0]).toFixed(2) + '%'
            );
        else
            $('#CachedDailyCallCount').html(0);

        if(adapter.DailyCallCount[0])
            $('#CachedWeeklyCallCount').html(
                100-(cachedAdapter.WeeklyCallCount[0]/adapter.WeeklyCallCount[0]).toFixed(2) + '%'
            );
        else
            $('#CachedWeeklyCallCount').html(0);

        if(adapter.DailyCallCount[0])
            $('#CachedMonthlyCallCount').html(
                100-(cachedAdapter.MonthlyCallCount[0]/adapter.MonthlyCallCount[0]).toFixed(2) + '%'
            );
        else
            $('#CachedMonthlyCallCount').html(0);

        if(data.AdapterCalltatistics.TotalCount[0])
            $('#CachedTotalCallCount').html(
                100-(data.CachedAdapterCalltatistics.TotalCount[0]/data.AdapterCalltatistics.TotalCount[0]).toFixed(2) + '%'
            );
        else
            $('#CachedTotalCallCount').html(0);

        setTimeout(getCount, 5000)
    }, 'json');
}

$(function(){
    getCount();
});