<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Transactions') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <!-- Header dengan Judul -->
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h3 class="text-lg font-medium text-gray-900">Daftar Transaksi</h3>

            <!-- Tombol Aksi -->
            <div class="flex gap-2">
              <a href="{{ route('transactions') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all flex items-center shadow-md">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
              </a>
            </div>
          </div>

          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($transactions as $trx)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $trx->midtrans_order_id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $trx->name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    Rp {{ number_format($trx->gross_amount,0,',','.') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($trx->transaction_status == 'paid') bg-green-100 text-green-800
                                                @elseif($trx->transaction_status == 'unpaid') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                      {{ ucfirst($trx->transaction_status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $trx->created_at->format('d-m-Y H:i') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <a href="{{ route('transactions.sync', $trx->id) }}"
                      class="inline-flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-50 rounded-full hover:bg-blue-100 transition-colors"
                      title="Sync">
                      <i class="fas fa-sync-alt text-sm"></i>
                    </a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                    Tidak ada data transaksi
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          @if($transactions->hasPages())
          <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 mt-4">
            {{ $transactions->appends(request()->query())->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>