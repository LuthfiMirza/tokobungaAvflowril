<div class="p-4">
    <div class="text-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Bukti Pembayaran - {{ $orderNumber }}
        </h3>
    </div>
    
    <div class="flex justify-center">
        <img src="{{ $imageUrl }}" 
             alt="Bukti Pembayaran {{ $orderNumber }}" 
             class="max-w-full max-h-96 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
    </div>
    
    <div class="mt-4 text-center">
        <a href="{{ $imageUrl }}" 
           target="_blank" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            Buka di Tab Baru
        </a>
    </div>
</div>