<?php
require __DIR__ . '/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    return $client;
}


// code before the try-catch block
 
    try {
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Sheets($client);

        // Prints the names and majors of students in a sample spreadsheet:
        // https://docs.google.com/spreadsheets/d/1XJgrSD6YHnkH6-gAHNU1xVxsAGKliMfTqc1CbVseWAE/edit
        $spreadsheetId = '1XJgrSD6YHnkH6-gAHNU1xVxsAGKliMfTqc1CbVseWAE';
        $range = 'Sheet1!A:H';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            print "No data found.\n";
        } else {
            print "Name, Major:\n";
            foreach ($values as $row) {
                // Print columns A and E, which correspond to indices 0 and 4.
                printf("%s, %s\n", $row[0], json_encode($row));
                // printf($row);
            }
        }
  } catch (Exception $e) {
    // exception is raised and it'll be handled here
    // $e->getMessage() contains the error message

  }
   
?>