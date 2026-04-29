@if(is_null($value))
    <span class="text-xs text-gray-400 italic">- Kosong -</span>
@elseif(is_bool($value))
    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold {{ $value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        {{ $value ? 'TRUE' : 'FALSE' }}
    </span>
@elseif(is_array($value) || is_object($value))
    <pre class="text-[10px] font-mono bg-gray-100 dark:bg-gray-900 p-2 rounded border border-gray-200 dark:border-gray-700 overflow-x-auto whitespace-pre-wrap">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@elseif(strtotime($value) && strlen($value) > 10) 
    {{-- Deteksi Tanggal Sederhana --}}
    <span class="font-mono text-sm">{{ \Carbon\Carbon::parse($value)->format('d M Y H:i') }}</span>
@else
    <span class="break-all">{{ $value }}</span>
@endif