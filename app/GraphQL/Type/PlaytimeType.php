<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\PlaytimeModel;


class PlaytimeType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'PlaytimeType',
        'description'   => 'A type',
        'model'         => PlaytimeModel::class
    ];

    public function fields()
    {
        return [
        'player_id'    => [
				'type'          => Type::int(),
				'description'   => 'The Player ID',
			],
			'character_name'    => [
				'type'          => Type::string(),
				'description'   => 'The Character Name',
			],
			'character_time'    => [
				'type'          => Type::float(),
				'description'   => 'The Character Time',
			],
			'character_role'    => [
				'type'          => Type::string(),
				'description'   => 'The Character Role',
			],
			'character_kills'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Kills',
			],
			'character_deaths'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Deaths',
			],
			'character_healing_done'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Healing Done',
			],
			'character_damage_done'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Damage Done',
			],
			'character_games_played'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Games Played',
			],
			'character_games_won'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Games Won',
			],
			'character_games_lost'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Games Lost',
			],
			'character_games_draw'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Games Draw',
			],
			'character_winrate'    => [
				'type'          => Type::int(),
				'description'   => 'The Character Winrate',
			],
			'player'    => [
				'type'  => GraphQL::type('players'),
				'description'   => 'The Player',
			],
			'trends'   => [
				'type'          => Type::listOf(GraphQL::type('trends')),
				'description'   => 'Player Trends',
			],
        ];
    }
}