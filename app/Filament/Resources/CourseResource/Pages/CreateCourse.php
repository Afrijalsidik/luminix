<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    /**
     * Auto-set user_id ke instructor yang sedang login
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    /**
     * Redirect ke halaman edit setelah create (untuk langsung manage chapters)
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}