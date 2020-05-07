<?php

use \Khill\Lavacharts\DataTables\DataFactory;

// Underneath the DataFactory, this is just a shortcut to calling
// addColumns then addRows 
$data = DataFactory::DataTable([
    ['string', 'name'],
    ['number', 'donuts']
],[
    ['Jim', 4],
    ['Tom', 3],
    ['Mary', 2],
    ['Gary', 3],
    ['Larry', 1]
]);

// Taken straight from Google's example for BubbleCharts
// The method will assign colmun types based on the data from
// the rows (currently only strings and numbers)
$data = DataFactory::arrayToDataTable([
    ['ID', 'Life Expectancy', 'Fertility Rate', 'Region',     'Population'],
    ['CAN',    80.66,              1.67,      'North America',  33739900],
    ['DEU',    79.84,              1.36,      'Europe',         81902307],
    ['DNK',    78.6,               1.84,      'Europe',         5523095],
    ['EGY',    72.73,              2.78,      'Middle East',    79716203],
    ['GBR',    80.05,              2,         'Europe',         61801570],
    ['IRN',    72.49,              1.7,       'Middle East',    73137148],
    ['IRQ',    68.09,              4.77,      'Middle East',    31090763],
    ['ISR',    81.55,              2.96,      'Middle East',    7485600],
    ['RUS',    68.6,               1.54,      'Europe',         141850000],
    ['USA',    78.09,              2.05,      'North America',  307007000]
]);

// Excluding a header row and passing true as the second
// parameter will treat all rows as data.
$data = DataFactory::arrayToDataTable([
    ['Mon', 20, 28, 38, 45],
    ['Tue', 31, 38, 55, 66],
    ['Wed', 50, 55, 77, 80],
    ['Thu', 77, 77, 66, 50],
    ['Fri', 68, 66, 22, 15]
    // Treat first row as data as well.
], true);