<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Information')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Course::class, 'slug', ignoreRecord: true),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->required()
                            ->default('draft')
                            ->helperText('Only published courses can be enrolled by students.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                            ])
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                            ->directory('course-thumbnails')
                            ->columnSpanFull()
                            ->helperText('Max size: 2MB. Allowed: PNG, JPG, JPEG'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->size(60)
                    ->defaultImageUrl(url('/images/placeholder.png')),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('instructor.name')
                    ->label('Instructor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                    }),

                Tables\Columns\TextColumn::make('chapters_count')
                    ->label('Chapters')
                    ->counts('chapters')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('enrollments_count')
                    ->label('Students')
                    ->counts('enrollments')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ChaptersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                \Illuminate\Database\Eloquent\SoftDeletingScope::class,
            ]);

        // Instructor hanya bisa lihat kursus mereka sendiri
        // Admin bisa lihat semua kursus
        $user = auth()->user();

        if ($user->isInstructor()) {
            $query->where('user_id', $user->id);
        }

        return $query;
    }
}