<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="py-10 text-right">
            <div class="flex justify-end">
                <x-buttons.submit :name="'edit'"/>
            </div>
        </div>
    </form>

    <x-filament-actions::modals/>
</div>
