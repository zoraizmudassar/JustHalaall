<?php 
return [ 
    'client_id' => 'Acx9985VBxOKjTGVnALzC_oATnS7aE3lYRpmR1bs47UWVWJfhhNB0qU73JyiP-4NbPIyOZP81hfBTZ3e',
	'secret' => 'ELwexG9t7CGKat_NuTV6PQeQqjlhivYmJlIRFUpE_vaNGDlz8FIyrO7jfbvBr2GNPPsYKc_xfDj19-RE',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];