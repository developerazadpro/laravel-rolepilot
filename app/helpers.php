<?php
if (! function_exists('perm')) {
    /**
     * Usage: perm('users','create') -> "create users" or config override
     */
    function perm(string $module, string $action): string
    {
        // try config first: config/permissions.php (optional)
        $cfg = config("permissions.{$module}.{$action}");
        if ($cfg) return $cfg;

        // fallback to conventional permission naming
        return "{$action} {$module}";
    }
}
