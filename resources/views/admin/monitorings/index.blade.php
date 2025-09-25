<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Bandwidth') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @isset($error)
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        {{ $error }}
                    </div>
                    @else
                    <h3 class="text-lg font-medium mb-4">Router Information</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p><strong>Identity:</strong> {{ $identity }}</p>
                            <p><strong>Model:</strong> {{ $router }}</p>
                        </div>
                        <div>
                            <p><strong>Uptime:</strong> {{ $uptime }}</p>
                            <p><strong>CPU Load:</strong> {{ $cpu }}%</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium mb-4">Bandwidth per Interface</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-base font-bold">Interface</th>
                                    <th class="px-4 py-3 text-right text-base font-bold">Download</th>
                                    <th class="px-4 py-3 text-right text-base font-bold">Upload</th>
                                </tr>
                            </thead>
                            <tbody id="bandwidth" class="divide-y divide-gray-200">
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                        Loading...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            let prevData = {};

            async function updateStats() {
                const res = await fetch("{{ route('monitorings.stats') }}");
                const data = await res.json();

                if (data.status === "ok") {
                    let html = "";
                    data.interfaces.forEach(iface => {
                        let rxRate = "";
                        let txRate = "";

                        if (prevData[iface.name]) {
                            let rxDiff = iface.rx - prevData[iface.name].rx;
                            let txDiff = iface.tx - prevData[iface.name].tx;
                            rxRate = (rxDiff / 1024).toFixed(2) + " KB/s";
                            txRate = (txDiff / 1024).toFixed(2) + " KB/s";
                        }

                        prevData[iface.name] = {
                            rx: iface.rx,
                            tx: iface.tx
                        };

                        html += `
                            <tr>
                                <td class="px-4 py-2">${iface.name}</td>
                                <td class="px-4 py-2 text-right font-mono text-green-600 w-32">
                                    <span class="inline-block text-right w-full">${rxRate}</span>
                                </td>
                                <td class="px-4 py-2 text-right font-mono text-blue-600 w-32">
                                    <span class="inline-block text-right w-full">${txRate}</span>
                                </td>
                            </tr>
                        `;
                    });
                    document.getElementById("bandwidth").innerHTML = html;
                }
            }

            setInterval(updateStats, 1000);
        </script>
    </x-slot>
</x-app-layout>