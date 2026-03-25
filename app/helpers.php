<?php

use App\Models\Log;
use Illuminate\Support\Facades\DB;
// For add'active' class for activated route nav-item
function active_class($path, $active = 'active')
{
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path)
{
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path)
{
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}
function logActivity($action, $description = null)
{
  Log::create([
    'user_id' => auth()->check() ? auth()->id() : null,
    'action' => $action,
    'description' => $description,
    'ip_address' => request()->ip(),
  ]);
}

if (!function_exists('getSubCategoryName')) {
  function getSubCategoryName($id)
  {
    if (!$id) return null;

    return DB::table('sub_categories')
      ->where('SubCatID', $id)
      ->value('SubCategory') ?? 'N/A';
  }
}

if (!function_exists('getListingTypeName')) {
  function getListingTypeName($id)
  {
    if (!$id) return null;

    return DB::table('listing_types')
      ->where('ListType', $id)
      ->value('Description') ?? 'N/A';
  }
}

if (!function_exists('getReferralTypeName')) {
  function getReferralTypeName($id)
  {
    if (!$id) return null;

    return DB::table('referral_types')
      ->where('RefTypeID', $id)
      ->value('RefTypeDescript') ?? 'N/A';
  }
}

if (!function_exists('getReferralSourcesName')) {
  function getReferralSourcesName($id)
  {
    if (!$id) return null;

    return DB::table('referral_sources')
      ->where('RefID', $id)
      ->value('RefSourceDescrip') ?? 'N/A';
  }
}
