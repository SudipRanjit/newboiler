<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/**
 * Get list of months
 *
 * @return array
 */
function getMonths()
{
  return [
    1 => "Jan",
    2 => "Feb",
    3 => "Mar",
    4 => "Apr",
    5 => "May",
    6 => "Jun",
    7 => "Jul",
    8 => "Aug",
    9 => "Sep",
    10 => "Oct",
    11 => "Nov",
    12 => "Dec"
  ];
}

/**
 * Get list of days
 *
 * @return array
 */
function getDays()
{
  $days = [];

  for ($day = 1; $day <= 32; $day++) {
    $days[$day] = $day;
  }

  return $days;
}

/**
 * Organize published date
 *
 * @param \Illuminate\Http\Request $request
 * @return string
 */
function organizePublishedDate(\Illuminate\Http\Request $request)
{

  $request->hour = (strlen($request->hour) == 1) ? '0' . $request->hour : $request->hour;
  $request->minute = (strlen($request->minute) == 1) ? '0' . $request->minute : $request->minute;

  return $request->year . '-' . $request->month . '-' . $request->day . ' ' . $request->hour . ':' . $request->minute . ':00';
}

function getNepaliDate($date_ad)
{
    $nepaliDate = convertToBS($date_ad);

    // return $nepaliDate['day'] . ', ' . $nepaliDate['nmonth'] . ' ' . $nepaliDate['date'] . ', ' . $nepaliDate['year'];
    return $nepaliDate['nmonth'] . ' ' . $nepaliDate['date'] . ', ' . $nepaliDate['year'];
}

function getNepaliDateTime($date_ad)
{
    $nepaliDate = convertToBS($date_ad);

    //return $nepaliDate['day'] . ', ' . $nepaliDate['nmonth'] . ' ' . $nepaliDate['date'] . ', ' . $nepaliDate['year'] . ', ' . $nepaliDate['time'];
    return $nepaliDate['nmonth'] . ' ' . $nepaliDate['date'] . ', ' . $nepaliDate['year'] . ' <span class="far fa-clock"></span>' . $nepaliDate['time'];
}

function getNepaliDateDay($date_ad)
{
    $nepaliDate = convertToBS($date_ad);

    return $nepaliDate['nmonth'] . ' ' . $nepaliDate['date'];
}

function convertToBS($date_ad)
{
    $dateConverter = new \App\Webifi\Services\DateConverter();

    if ($date_ad == "0000-00-00 00:00:00")
        $date_ad = date("Y-m-d H:i:s");

    $date_ad = strtotime($date_ad);
    $year = date('Y', $date_ad) ?? date('Y');
    $month = date('m', $date_ad) ?? date('m');
    $day = date('d', $date_ad) ?? date('d');
    // $time = date('g:ia', $date_ad);

    $time = date('H:i', $date_ad);
    $date_bs = $dateConverter->ad_2_bs($year, $month, $day);
    $date_bs['year'] = convertToNepali($date_bs['year']);
    $date_bs['month'] = convertToNepali($date_bs['month']);
    $date_bs['date'] = convertToNepali($date_bs['date']);
    $date_bs['time'] = convertToNepali($time);

    return $date_bs;

}

/**
 * Converts english digits to nepali numbers
 *
 * @param $str
 *
 * @return int|string
 */
function convertToNepali($str)
{
    $str = ("string" != gettype($str)) ? strval($str) : $str;
    $array = [
        0 => '०',
        1 => '१',
        2 => '२',
        3 => '३',
        4 => '४',
        5 => '५',
        6 => '६',
        7 => '७',
        8 => '८',
        9 => '९',
    ];
    $utf = "";
    $cnt = strlen($str);
    for ($i = 0; $i < $cnt; $i++) {
        if (!isset($array[$str[$i]])) {
            $utf .= $str[$i];
        } else
            $utf .= $array[$str[$i]];
    }

    return $utf;
}

/**
 * Save Image With watermark
 *
 * @param $destinationPath
 * @param $filename
 * @param $image
 */
function saveImageWithWatermark($destinationPath, $filename, $image)
{

  $path = $destinationPath . $filename;

  $myImage = Image::make($image->getRealPath());

  $waterMark = public_path('uploads/watermark/small-logo.png');

  $myImage->insert($waterMark, 'bottom-right');


  $myImage->save($path);
}

/**
 * Save Image With watermark
 *
 * @param $destinationPath
 * @param $filename
 * @param $image
 */
function saveImageWithOutWatermark($destinationPath, $filename, $image)
{

  $path = $destinationPath . $filename;
  $myImage = Image::make($image->getRealPath());

  $myImage->save($path);
}

/**
 * Upload image
 *
 * @param $request
 * @return string
 */
function uploadImage($request, $imageName, $path)
{
  $image = $request->file($imageName);
  $imageName = rand(1, 999999) . time() . '.' . $image->getClientOriginalExtension();

  $destinationPath = public_path($path);
  $image->move($destinationPath, $imageName);
  //saveImageWithWatermark($destinationPath, $imageName, $image);
  return $imageName;
}

function getGuard()
{
  if (Auth::guard('web')->check()) {
    return "web";
  } 
}

function redirectToGuard($guard)
{
  switch($guard)
  {
    case 'web': 
      return redirect()->intended('admin');
  }
}

function cacheRemember($key, $ttl, Closure $callback)
{
    if (env('CACHE_DRIVER') == 'redis') {
        $value = Redis::get($key);

        if (!is_null($value)) {
            return unserialize($value);
        }

        Redis::set($key, $value = serialize($callback()));

        Redis::expire($key, $ttl * 60);

        return unserialize($value);
    } else {
        return $callback();
    }
}

function clearCache($message = '')
{
    if (env('CACHE_DRIVER') == 'redis') {
        try {
            if (env('APP_ENV') == 'production'
                || env('APP_ENV') == 'local'
                || env('APP_ENV') == 'development') {
                Redis::flushDB();

                Artisan::call('cache:clear');
                if (env('APP_ENV') == 'production')
                    exec('curl -k -X KHELFULLBANN ' . asset('') . '/*');

                logger('Cache Cleared! ' . $message);
            }
        } catch (\Exception $e) {
            logger((string)$e);
        }
    } else {
        logger('Driver not set to Redis. Log message - ' . $message);
        return null;
    }
}


function get_string_between($string, $start, $end){
  $string = ' ' . $string;
  $ini = strpos($string, $start);
  if ($ini == 0) return '';
  $ini += strlen($start);
  $len = strpos($string, $end, $ini) - $ini;
  return substr($string, $ini, $len);
}

function trimWords($string)
{
  return Str::limit($string, 150, $end='...');
}

function currentUserName()
{
  return auth()->user()->name;
}