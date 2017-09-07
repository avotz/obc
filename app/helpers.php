<?php 

use Illuminate\Support\Facades\Session;



function money($amount, $symbol = '₡')
{
    return (!$symbol) ? number_format($amount, 2, ".", ",") : $symbol . number_format($amount, 2, ".", ",");
}
function number($amount)
{
    return preg_replace("/([^0-9\\.])/i", "", $amount);
}
function percent($amount, $symbol = '%')
{
    return $symbol . number_format($amount, 0, ".", ",");
}
function age($birthdate)
{
	return $birthdate;
}

function zerofill($valor, $longitud){
    $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
    return $res;
}
function flash($message, $level = 'info')
{
	session()->flash('flash_message',$message);
	session()->flash('flash_message_level',$level);
}
function paginate($items, $perPage)
{
    $pageStart           = \Request::get('page', 1);
    $offSet              = ($pageStart * $perPage) - $perPage;
    $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);

    return new Illuminate\Pagination\LengthAwarePaginator(
        $itemsForCurrentPage, count($items), $perPage,
        Illuminate\Pagination\Paginator::resolveCurrentPage(),
        ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );
}
/*function set_active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }*/

function set_active($path, $active = 'active')
{   
  
    return Request::is($path) ? $active : '';
}

function dayName($day)
{
    $dayName = "";

    if(Carbon\Carbon::SUNDAY == $day)                          // int(0)
        $dayName = "Domingo";

    if(Carbon\Carbon::MONDAY == $day)                       // int(1)
        $dayName = "Lunes";

    if(Carbon\Carbon::TUESDAY == $day)                         // int(2)
        $dayName = "Martes";

    if(Carbon\Carbon::WEDNESDAY == $day)                       // int(3)
        $dayName = "Miércoles";

    if(Carbon\Carbon::THURSDAY == $day)                       // int(4)
        $dayName = "Jueves";

    if(Carbon\Carbon::FRIDAY == $day)                          // int(5)
        $dayName = "Viernes";

    if(Carbon\Carbon::SATURDAY == $day)                        // int(6)
        $dayName = "Sábado";

    return $dayName;
}
function getFlag($country)
{
   
    $url = '';
    
    $url = "/img/flags/". str_slug($country).".png";

    return $url;
        
     
}
function getAvatar($user)
{
   

    $url = '';
    
    if(Storage::disk('public')->exists('avatars/'. $user->id.'/avatar.jpg'))
        $url = Storage::url('avatars/'.$user->id.'/avatar.jpg');
    else
        $url = "/img/default-avatar.jpg";

    return $url;
        
     
}
function getLogo($clinic)
{
   

    $url = '';
    
    if(Storage::disk('public')->exists('offices/'. $clinic->id.'/photo.jpg'))
        $url = Storage::url('offices/'.$clinic->id.'/photo.jpg');
    else
        $url = "/img/logo.png";

    return $url;
        
     
}
