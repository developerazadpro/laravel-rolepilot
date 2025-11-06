<?php

namespace App\Models;

use App\Traits\LogsAllChanges;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use LogsAllChanges;
    
    protected $fillable = [
        'name', 'route', 'icon', 'parent_id', 'order', 'permission_name', 'is_active'
    ];

    public function roles()
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'menu_role');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    // Get menus visible to a specific user, based on permissions.
    public static function visibleTo($user, $search = null)
    {
        // Build the query first
        $query = static::with('children')->orderBy('order');

        // Apply search filter if provided
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Get all matching menus
        $menus = $query->get();
        
        return $menus->filter(function ($menu) use ($user) {
                // Only show parent menu if user can view it
                $showParent = $menu->permission_name ? $user->can($menu->permission_name) : true;

                // Filter children
                $menu->children = $menu->children->filter(function ($child) use ($user) {
                    return $child->permission_name ? $user->can($child->permission_name) : true;
                });

                // Only show parent if it passes OR has visible children
                return $showParent || $menu->children->count() > 0;
            });
    }

}
