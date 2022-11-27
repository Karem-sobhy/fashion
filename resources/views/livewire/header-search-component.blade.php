<div class="search-bar">
    <div class="container bg-white">
        <div class="d-flex justify-content-center py-5">
            <div class="search position-relative">
                <input wire:keydown.enter='search()' type="text" wire:model='search'
                    class="form-control border border-2 rounded rounded-pill"
                    placeholder="Search Here What You Need..." />
                <div wire:click.prevent='search()' style="cursor: pointer"
                    class="s-icon text-black-50 border-start border-dark border-opacity-50 border-1 ps-2">
                    <i class="fa fa-search"></i>
                </div>
            </div>
        </div>
    </div>
</div>
