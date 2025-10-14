<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Course;

class PopularCourses extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->heading('Most Popular Courses')
            ->query(
                Course::query()
                    ->when($user->isInstructor(), function ($query) use ($user) {
                        // Instructor: hanya kursus mereka
                        $query->where('user_id', $user->id);
                    })
                    ->where('status', 'published')
                    ->with(['category', 'instructor'])
                    ->withCount('enrollments')
                    ->orderBy('enrollments_count', 'desc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->size(60)
                    ->defaultImageUrl(asset('images/placeholder.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Course Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('instructor.name')
                    ->label('Instructor')
                    ->icon('heroicon-o-user')
                    ->iconColor('warning'),

                Tables\Columns\TextColumn::make('enrollments_count')
                    ->label('Students')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-users')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('enrollments_count', 'desc');
    }
}