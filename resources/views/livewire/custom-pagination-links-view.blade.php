<div>
    @if ($paginator->hasPages())
    <nav class="blog-pagination" aria-label="Pagination">
        <button wire:click="previousPage" wire:loading.attr="disabled" {{$paginator->onFirstPage() ? 'disabled':''}} class="btn btn-outline-primary rounded-pill">Sebelumnya</button>
        <button wire:click="nextPage" wire:loading.attr="disabled" {{$paginator->hasMorePages() ? '':'disabled'}} class="btn btn-outline-primary rounded-pill">Selanjutnya</button>
    </nav>
    @endif
</div>