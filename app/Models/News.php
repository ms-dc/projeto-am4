<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'description', 'image'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if ($filter) {
                $query->where('title', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })->paginate();
        return $results;
    }
}
