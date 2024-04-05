<div>
    
    <x-pagination 
        :has-pages="$paginator->hasPages()"
        :first-page="$paginator->onFirstPage()"
        :current-page="$paginator->currentPage()"
        :more-pages="$paginator->hasMorePages()"
        :total-pages="$paginator->lastPage()"
        :prev-page-click="'previousPage'"
        :next-page-click="'nextPage'"
    />

</div>