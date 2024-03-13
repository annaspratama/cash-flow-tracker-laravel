<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserTableCollection extends ResourceCollection
{
    public static $wrap = 'rows';
    private int $totalRows;

    public function __construct(mixed $resource, int $totalRows = 0)
    {
        parent::__construct($resource);

        $this->totalRows = $totalRows;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): mixed
    {
        $this->collection = $this->collection->each(callback: function ($value, $key) {
            $value->num = $key + 1;
        });

        return [
            'total' => $this->totalRows,
            'totalNotFiltered' => $this->collection->count(),
            'rows' => UserTableResource::collection(resource: $this->collection)
        ];
    }
}
