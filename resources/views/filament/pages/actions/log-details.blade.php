<div class="space-y-6">
    {{-- 1. HEADER INFORMASI --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <p class="text-xs font-bold text-gray-500 uppercase mb-1 tracking-wider dark:text-gray-400">Deskripsi Aktivitas</p>
            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $record->description }}</p>
        </div>
        <div class="p-4 rounded-lg bg-gray-50 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
             <p class="text-xs font-bold text-gray-500 uppercase mb-1 tracking-wider dark:text-gray-400">Target Subject</p>
             <div class="flex items-center gap-2">
                 <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded dark:bg-blue-900 dark:text-blue-300">
                     {{ class_basename($record->subject_type) }}
                 </span>
                 <span class="text-sm text-gray-600 dark:text-gray-300">ID: {{ $record->subject_id ?? '-' }}</span>
             </div>
        </div>
    </div>

    {{-- 2. TABEL PERUBAHAN DATA --}}
    <div>
        <h3 class="text-sm font-bold text-gray-800 mb-3 dark:text-gray-200">
            Detail Perubahan
        </h3>

        @if($record->changes && is_array($record->changes) && count($record->changes) > 0)
            <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm dark:border-gray-700">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3 font-bold uppercase text-xs w-1/4">Atribut</th>
                            <th class="px-4 py-3 font-bold uppercase text-xs w-1/3 border-l border-gray-200 dark:border-gray-600 text-red-600 dark:text-red-400">Sebelum (Old)</th>
                            <th class="px-4 py-3 font-bold uppercase text-xs w-1/3 border-l border-gray-200 dark:border-gray-600 text-green-600 dark:text-green-400">Sesudah (New)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @foreach($record->changes as $key => $change)
                            @php
                                $old = is_array($change) && array_key_exists('old', $change) ? $change['old'] : null;
                                $new = is_array($change) && array_key_exists('new', $change) ? $change['new'] : (is_string($change) ? $change : null);
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                {{-- Kolom Atribut --}}
                                <td class="px-4 py-3 align-top text-gray-800 dark:text-gray-200">
                                    <span class="font-semibold block">{{ str($key)->headline() }}</span>
                                    <span class="text-[10px] text-gray-400 font-mono">{{ $key }}</span>
                                </td>

                                {{-- Kolom Lama (Merah) --}}
                                <td class="px-4 py-3 align-top bg-red-50/50 dark:bg-red-900/10 border-l border-red-100 dark:border-red-900/30">
                                    @if(is_null($old))
                                        <span class="text-xs text-gray-400 italic">- Kosong -</span>
                                    @elseif(is_bool($old))
                                        <span class="px-2 py-0.5 text-xs font-bold rounded {{ $old ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $old ? 'TRUE' : 'FALSE' }}
                                        </span>
                                    @elseif(is_array($old) || is_object($old))
                                        <pre class="text-xs font-mono text-red-700 dark:text-red-400 whitespace-pre-wrap">{{ json_encode($old, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @else
                                        <span class="text-red-700 dark:text-red-400 font-medium break-all">{{ $old }}</span>
                                    @endif
                                </td>

                                {{-- Kolom Baru (Hijau) --}}
                                <td class="px-4 py-3 align-top bg-green-50/50 dark:bg-green-900/10 border-l border-green-100 dark:border-green-900/30">
                                    @if(is_null($new))
                                        <span class="text-xs text-gray-400 italic">- Kosong -</span>
                                    @elseif(is_bool($new))
                                        <span class="px-2 py-0.5 text-xs font-bold rounded {{ $new ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $new ? 'TRUE' : 'FALSE' }}
                                        </span>
                                    @elseif(is_array($new) || is_object($new))
                                        <pre class="text-xs font-mono text-green-700 dark:text-green-400 whitespace-pre-wrap">{{ json_encode($new, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @else
                                        <span class="text-green-700 dark:text-green-400 font-bold break-all">{{ $new }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- Empty State --}}
            <div class="p-6 text-center bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada detail atribut yang tercatat.</p>
            </div>
        @endif
    </div>
    
    {{-- 3. FOOTER --}}
    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs text-gray-400">
        <span class="font-mono">Log ID: #{{ $record->id }}</span>
        <span>{{ $record->created_at->format('d/m/Y H:i') }}</span>
    </div>
</div>