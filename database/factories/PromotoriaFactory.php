<?php

namespace Database\Factories;

use App\Models\Espelho;
use App\Models\GrupoPromotoria;
use App\Models\InternalSystemUser;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class PromotoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'                => fake()->name(),
            'is_especializada'    => rand(0, 1),
            'espelho_id'          => Espelho::query()->first()->id,
            'promotor_titular_id' => $this->searchPromotorId(),
            'grupo_promotoria_id' => GrupoPromotoria::query()->inRandomOrder()->first()->id,
        ];
    }

    public function searchPromotorId(): int
    {
        return InternalSystemUser::query()
            ->where('matricula', 'like', '10%')
            ->inRandomOrder()
            ->first()
            ->id;
    }
}
