<?php
use App\Models\Log;
// For add'active' class for activated route nav-item
function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
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