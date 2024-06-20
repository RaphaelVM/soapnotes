<div>
    <form wire:submit="create">
        {{ $this->form }}

        <div class="py-10 text-right">
            <div class="flex justify-end">
                <x-buttons.submit :name="'create'"/>
            </div>
        </div>
    </form>

    <x-filament-actions::modals/>
</div>
