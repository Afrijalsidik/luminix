<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ChaptersRelationManager extends RelationManager
{
    protected static string $relationship = 'chapters';

    protected static ?string $title = 'Course Chapters';

    protected static ?string $icon = 'heroicon-o-book-open';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(function () {
                        $lastOrder = $this->getOwnerRecord()
                            ->chapters()
                            ->max('order');
                        return $lastOrder + 1;
                    })
                    ->helperText('Chapter order in the course (auto-filled with next number)'),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'heading',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->helperText('Write your chapter content here.'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->width(80)
                    ->alignCenter()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->limit(100)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Chapter'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->paginated([10, 25, 50]);
    }
}