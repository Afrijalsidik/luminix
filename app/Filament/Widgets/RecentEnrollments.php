<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Enrollment;

class RecentEnrollments extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->heading('Recent Enrollments')
            ->query(
                Enrollment::query()
                    ->when($user->isInstructor(), function ($query) use ($user) {
                        // Instructor: hanya enrollments di kursus mereka
                        $query->whereHas('course', function ($q) use ($user) {
                            $q->where('user_id', $user->id);
                        });
                    })
                    ->with(['student', 'course.category'])
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(fn(Enrollment $record): string => $record->course->title),

                Tables\Columns\TextColumn::make('course.category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->formatStateUsing(fn(string $state): string => $state . '%')
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state >= 100 => 'success',
                        $state >= 50 => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'warning',
                        'completed' => 'success',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'active' => 'heroicon-o-clock',
                        'completed' => 'heroicon-o-check-circle',
                    }),

                Tables\Columns\TextColumn::make('enrolled_at')
                    ->label('Enrolled At')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->icon('heroicon-o-calendar'),
            ])
            ->defaultSort('enrolled_at', 'desc');
    }
}