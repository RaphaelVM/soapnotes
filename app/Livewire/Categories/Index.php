<?php

namespace App\Livewire\Categories;

use App\Models\Category;
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
            ->query(Category::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->url(fn (Category $record): string => route('categories.edit', $record))
                    ->icon('heroicon-o-pencil')
                    ->color('info'),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn (Category $record) => $record->delete()),
            ])
            ->headerActions([
                Action::make('create')
                    ->url(route('categories.create'))
                    ->icon('heroicon-o-plus')
                    ->color('indigo'),
            ]);
    }

    public function render(): View
    {
        return view('livewire.categories.index');
    }
}
