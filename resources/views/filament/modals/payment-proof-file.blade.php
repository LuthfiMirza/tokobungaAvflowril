<div class="p-4">
    <div class="text-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Bukti Pembayaran - {{ $orderNumber }}
        </h3>
    </div>
    
    <div class="flex flex-col items-center space-y-4">
        <div class="flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <svg class="w-10 h-10 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        
        <div class="text-center">
            <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">{{ $fileName }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">File bukti pembayaran</p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ $fileUrl }}" 
               target="_blank" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Lihat File
            </a>
            
            <a href="{{ $fileUrl }}" 
               download 
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download
            </a>
        </div>
    </div>
</div>