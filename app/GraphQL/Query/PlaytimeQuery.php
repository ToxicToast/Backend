<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

use App\Models\Overwatch\PlaytimeModel;

class PlaytimeQuery extends Query
{
    protected $attributes = [
        'name' => 'PlaytimeQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('playtime'));
    }

    public function args()
    {
        return [
            'player_id' => ['name' => 'player_id', 'type' => Type::int()],
            'character_role' => ['name' => 'character_role', 'type' => Type::string()],
            'limit' => ['name' => 'limit', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $where = function ($query) use ($args) {
            if (isset($args['player_id'])) {
                $query->where('player_id', $args['player_id']);
            }
            if (isset($args['character_role'])) {
                $query->where('character_role', $args['character_role']);
            }
            // $query->where('character_time', '>', '0');
        };
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        //
        $playtime = PlaytimeModel::where($where);
        $playtime->select($select);
        if (isset($args['limit'])) {
            $playtime->take($args['limit']);
        }
        $playtime->orderBy('character_time', 'DESC');
        $playtime->with($with);
        $characters = collect($playtime->get());
        $unique = $characters->unique('character_name');
		return $unique->all();
    }
}