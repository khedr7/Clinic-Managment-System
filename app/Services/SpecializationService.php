<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Specialization;

class SpecializationService
{
    use ModelHelper;

    public function getAll()
    {
        return Specialization::get();
    }

    public function find($specializationId)
    {
        return $this->findByIdOrFail(Specialization::class, 'Specialization', $specializationId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $specialization = Specialization::create($validatedData);

        if (isset($validatedData['image'])) {
            $specialization->addMedia($validatedData['image'])->toMediaCollection('image');
        }

        DB::commit();

        return $specialization;
    }

    public function update($validatedData, $specializationId)
    {
        $specialization = $this->find($specializationId);

        DB::beginTransaction();

        $specialization->update($validatedData);

        if (isset($validatedData['image'])) {
            $specialization->clearMediaCollection('image');
            $specialization->addMedia($validatedData['image'])->toMediaCollection('image');
        }

        DB::commit();

        return true;
    }

    public function delete($specializationId)
    {
        $specialization = $this->find($specializationId);

        DB::beginTransaction();

        $specialization->clearMediaCollection('image');
        $specialization->delete();

        DB::commit();

        return true;
    }
}
