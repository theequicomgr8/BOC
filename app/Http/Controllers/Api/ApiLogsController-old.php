<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ApiLogs;
use Illuminate\Support\Facades\Validator;
use DB;
//use Validator;

use Carbon\Carbon;

class ApiLogsController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }


    public function get_activity_details()
    {
        $table = 'activity';
        $result = ApiLogs::fetchAllRecords($table);
        
        if(($result->isEmpty())) 
        {
            return $this->sendError('Activity not found.');
            exit;
        }

        return $this->sendResponse($result, 'All activity data.');
    }


    public function save_activity_logs(Request $request)
    {
        $data = ['Client_IP' => $request->client_ip,
                   'Userid' => $request->user_id,
                   'Activity_Id' => $request->activity_id,
                   'PageviewURL' => $request->page_url,
                   'Module_Id' => $request->Module_Id,
                ];

        $table = 'activity_logs';
        $insert_logs = ApiLogs::insertSingleData($table,$data);

        if($insert_logs)
        { 
            $result = [];
            return $this->sendResponse($result,'Logs inserted successfully.');
        }
        else
        {
            return $this->sendError('Logs not inserted.');
        }
    }

}
