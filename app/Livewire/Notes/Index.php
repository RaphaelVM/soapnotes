<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Note::query())
            ->columns([
                // Display only the names of the categories associated with the note

                TextColumn::make('categories')
                    ->label('Categories')
                    ->formatStateUsing(function ($record) {
                        return $record->categories->pluck('name')->join(', ');
                    }),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('content')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->url(fn (Note $record): string => route('notes.edit', $record))
                    ->icon('heroicon-o-pencil')
                    ->color('indigo'),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn (Note $record) => $record->delete()),
            ])
            ->headerActions([
                Action::make('create')
                    ->url(route('notes.create'))
                    ->icon('heroicon-o-plus')
                    ->color('indigo'),
            ]);
    }

    public function render(): View
    {
        return view('livewire.notes.index');
    }
}
