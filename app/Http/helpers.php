<?php

function admin_assets($dir)
{
    return url('/admin_assets/assets/' . $dir);
}

function getLocal()
{
    return app()->getLocale();
}
function checkNewOrder(){
    return \App\Models\Order::query()->where('seen','0')->count();
}

function checkNewContacts(){
    return \App\Models\Contact::query()->where('seen','0')->count();
}

function deleteEmptyTags($text){
    $pattern = "/<p[^>]*><\\/p[^>]*>/";
    return  preg_replace($pattern, '', $text);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function mainResponse($status, $msg, $items, $validator, $is_validator = 0)
{
    $aryErrors = [];
    if ($is_validator == 0) {
        if ($validator != []) {
            $errors = ($validator->errors()->toArray());
            foreach ($errors as $key => $value) {
                $tmp = ["fieldname" => $key, "message" => $value[0]];
                array_push($aryErrors, $tmp);
            }
        }
    } else {
        $aryErrors = array($validator);
    }
    $newData = ['status' => $status, 'message' => __($msg), 'items' => $items, 'errors' => $aryErrors];
    return response()->json($newData);
}

function validationResponse($errors, $key)
{
//    $errors = $validator->errors();
//    $errors = $errors->toArray();
    $message = '';
    foreach ($errors as $key => $value) {
        $message .= $value[0] . ',';
    }
    $message = substr($message, 0, -1);
    return mainResponse(false, $message, null, 203, $key);
}

function currencyConverter($from_Currency, $to_Currency, $amount)
{
    $from_Currency = \App\Models\Currency::query()->where('name', $from_Currency)->first()->usd_value;
    $to_Currency = \App\Models\Currency::query()->where('name', $to_Currency)->first()->usd_value;
    return round((float)(($amount / $from_Currency) * $to_Currency), 2);
}
function slugURL($title){
    $WrongChar = array('@', '؟', '.', '!','?','&','%','$','#','{','}','(',')','"',':','>','<','/','|','{','^');

    $titleNoChr = str_replace($WrongChar, '', $title);
    $titleSEO = str_replace(' ', '-', $titleNoChr);
    return $titleSEO;
}