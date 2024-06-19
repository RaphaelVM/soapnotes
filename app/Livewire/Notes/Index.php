<?php

namespace App\Livewire\Notes;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
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
        $table->columns([
            Column::make('title'),
            Column::make('content'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ])->filters([
            Filter::make('search'),
        ])->actions([
            Action::make('edit'),
            Action::make('delete'),
        ]);
    }

    public function render(): View
    {
        return view('livewire.notes.index');
    }
}
