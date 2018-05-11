<?php 

use Illuminate\Support\Facades\Session;

function money($amount, $symbol = '₡')
{
    return (!$symbol) ? number_format($amount, 2, '.', ',') : $symbol . number_format($amount, 2, '.', ',');
}
function number($amount)
{
    return preg_replace('/([^0-9\\.])/i', '', $amount);
}
function percent($amount, $symbol = '%')
{
    return $symbol . number_format($amount, 0, '.', ',');
}
function age($birthdate)
{
    return $birthdate;
}

function zerofill($valor, $longitud)
{
    $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
    return $res;
}
function flash($message, $level = 'info')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_message_level', $level);
}
function paginate($items, $perPage)
{
    $pageStart = \Request::get('page', 1);
    $offSet = ($pageStart * $perPage) - $perPage;
    $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

    return new Illuminate\Pagination\LengthAwarePaginator(
        $itemsForCurrentPage,
        count($items),
        $perPage,
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
    $dayName = '';

    if (Carbon\Carbon::SUNDAY == $day) {                          // int(0)
        $dayName = 'Domingo';
    }

    if (Carbon\Carbon::MONDAY == $day) {                       // int(1)
        $dayName = 'Lunes';
    }

    if (Carbon\Carbon::TUESDAY == $day) {                         // int(2)
        $dayName = 'Martes';
    }

    if (Carbon\Carbon::WEDNESDAY == $day) {                       // int(3)
        $dayName = 'Miércoles';
    }

    if (Carbon\Carbon::THURSDAY == $day) {                       // int(4)
        $dayName = 'Jueves';
    }

    if (Carbon\Carbon::FRIDAY == $day) {                          // int(5)
        $dayName = 'Viernes';
    }

    if (Carbon\Carbon::SATURDAY == $day) {                        // int(6)
        $dayName = 'Sábado';
    }

    return $dayName;
}
function getFlag($country)
{
    $url = '';

    $url = '/img/flags/' . str_slug($country) . '.png';

    return $url;
}
function getAvatar($user)
{
    $url = '';

    if (Storage::disk('public')->exists('avatars/' . $user->id . '/avatar.jpg')) {
        $url = Storage::url('avatars/' . $user->id . '/avatar.jpg');
        $url = $url . '?' . uniqid();
    } else {
        $url = '/img/default-avatar.jpg';
    }

    return $url;
}
function getLogo($company)
{
    $url = '';

    if (Storage::disk('public')->exists('companies/' . $company->id . '/logo.jpg')) {
        $url = Storage::url('companies/' . $company->id . '/logo.jpg');
        $url = $url . '?' . uniqid();
    } else {
        $url = '/img/logo-default.png';
    }

    return $url;
}
function getCreditRequestFile($creditRequest)
{
    $url = '';
    if (!$creditRequest->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('credit-requests/' . $creditRequest->id . '/files/' . $creditRequest->file)) {
        $url = Storage::url('credit-requests/' . $creditRequest->id . '/files/' . $creditRequest->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getCreditFile($credit)
{
    $url = '';
    if (!$credit->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('credits/' . $credit->id . '/files/' . $credit->file)) {
        $url = Storage::url('credits/' . $credit->id . '/files/' . $credit->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getShippingRequestFile($shippingRequest)
{
    $url = '';
    if (!$shippingRequest->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('shippings-requests/' . $shippingRequest->id . '/files/' . $shippingRequest->file)) {
        $url = Storage::url('shippings-requests/' . $shippingRequest->id . '/files/' . $shippingRequest->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getShippingFile($shipping)
{
    $url = '';
    if (!$shipping->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('shippings/' . $shipping->id . '/files/' . $shipping->file)) {
        $url = Storage::url('shippings/' . $shipping->id . '/files/' . $shipping->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getQuotationFile($quotation)
{
    $url = '';
    if (!$quotation->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('quotations/' . $quotation->id . '/files/' . $quotation->file)) {
        $url = Storage::url('quotations/' . $quotation->id . '/files/' . $quotation->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getRequestFile($request)
{
    $url = '';
    if (!$request->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('requests/' . $request->id . '/files/' . $request->file)) {
        $url = Storage::url('requests/' . $request->id . '/files/' . $request->file);
    } else {
        $url = '#';
    }

    return $url;
}
function getRequestProductPhoto($request)
{
    $url = '';

    if (!$request->product_photo) {
        return '#';
    }

    if (Storage::disk('public')->exists('requests/' . $request->id . '/product/' . $request->product_photo)) {
        $url = Storage::url('requests/' . $request->id . '/product/' . $request->product_photo);
    } else {
        $url = '#';
    }

    return $url;
}
function getQuotationProductPhoto($quotation)
{
    $url = '';
    if (!$quotation->product_photo) {
        return '#';
    }

    if (Storage::disk('public')->exists('quotations/' . $quotation->id . '/product/' . $quotation->product_photo)) {
        $url = Storage::url('quotations/' . $quotation->id . '/product/' . $quotation->product_photo);
    } else {
        $url = '#';
    }

    return $url;
}
function getFilePurchase($purchase)
{
    $url = '';

    if (!$purchase->file) {
        return '#';
    }

    if (Storage::disk('public')->exists('purchases/' . $purchase->id . '/files/' . $purchase->file)) {
        $url = Storage::url('purchases/' . $purchase->id . '/files/' . $purchase->file);
    } else {
        $url = '#';
    }

    return $url;
}

function calculatePercentAmount($percent, $amount)
{
    return ($percent / 100) * $amount;
}

function get_depth($depth)
{
    return str_repeat('<span class="depth">—</span>', $depth);
}

function validationRequiredES($field)
{
    return 'El campo ' . $field . ' es requerido';
}

function is_blank($value)
{
    return empty($value) && !is_numeric($value);
}
